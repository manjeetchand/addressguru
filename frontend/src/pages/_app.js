"use client";

import { useEffect, useState } from "react";
import { useRouter } from "next/router";
import Footer from "@/layout/footer";
import Header from "@/layout/header";
import Loader from "@/components/Loader";
import "@/styles/globals.css";
import MobileSearchBar from "@/components/MobileSearchBar";
import MobileFooter from "@/components/MobileFooter";
import { AuthProvider } from "@/context/AuthContext";
import { GoogleOAuthProvider } from "@react-oauth/google";

export default function App({ Component, pageProps }) {
  const router = useRouter();

  const [loading, setLoading] = useState(false);
  const [isDesktop, setIsDesktop] = useState(false);

  /* ------------------ DESKTOP CHECK ------------------ */
  useEffect(() => {
    const handleResize = () => {
      setIsDesktop(window.innerWidth >= 768); // Tailwind md
    };

    handleResize();
    window.addEventListener("resize", handleResize);

    return () => window.removeEventListener("resize", handleResize);
  }, []);

  /* ------------------ ROUTE FLAGS ------------------ */
  const isDashboard = router.pathname.startsWith("/dashboard");
  const isSeeDetails = router.pathname.startsWith("/[slug]");
  const isCity = !!router.query.city && !!router.query.slug;

  const shouldShowHeader =
    !isDashboard && (!isSeeDetails || (isSeeDetails && isDesktop));

  const shouldShowFooter = !isDashboard && !isSeeDetails;

  /* ------------------ LOADER ------------------ */
  useEffect(() => {
    const handleStart = () => setLoading(true);
    const handleComplete = () => setLoading(false);

    router.events.on("routeChangeStart", handleStart);
    router.events.on("routeChangeComplete", handleComplete);
    router.events.on("routeChangeError", handleComplete);

    return () => {
      router.events.off("routeChangeStart", handleStart);
      router.events.off("routeChangeComplete", handleComplete);
      router.events.off("routeChangeError", handleComplete);
    };
  }, [router]);

  return (
    <GoogleOAuthProvider clientId="477872652143-tciloohp49r48l80d7j6tqituovm9nu0.apps.googleusercontent.com">
      <AuthProvider>
        <div className="flex justify-center">
          <div className="w-full max-w-[1750px] relative">
            {/* ---------------- HEADER ---------------- */}
            {shouldShowHeader && (
              <div className="fixed top-0 left-0 right-0 z-50 flex justify-center">
                <div className="w-[1750px]">
                  <Header />
                  {!isSeeDetails && !isCity && <MobileSearchBar />}
                </div>
              </div>
            )}
            {/* ---------------- LOADER ---------------- */}
            {loading && <Loader />}

            {/* ---------------- PAGE CONTENT ---------------- */}
            <div
              className={shouldShowHeader ? "pt-[70px] max-md:pt-[105px]" : ""}
            >
              <Component {...pageProps} />
            </div>

            {/* ---------------- FOOTER ---------------- */}
            {shouldShowFooter && (
              <>
                <MobileFooter />
              </>
            )}
            <Footer />
          </div>
        </div>
      </AuthProvider>
    </GoogleOAuthProvider>
  );
}
