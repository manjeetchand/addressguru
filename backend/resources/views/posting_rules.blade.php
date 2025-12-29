<!DOCTYPE html>
<html lang="en">
<head> 
@extends('layouts.app')
    <title>Posting Rules | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="{{url('/')}}/posting-rules">
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 style="color:#337AB7;"><b>Posting Rules</b></h2><hr/>
			<ol>
				<li>Listing items that are illegal to buy, own, import or sell in the country of your residence. </li>
				<li>Listing your business not being located in India</li>
				<li>Listing Ad in other language than English</li>
				<li>Listing incomplete Ad</li>
				<li>Listing Ad which is discriminatory as per caste/religion/nationality.</li>
				<li>Listing multiple Ads with different accounts/mail Id</li>
				<li>Listing any type of Adult content/Ad</li>
				<li>Listing Ad regarding any political view that may offend </li>
				<li>Listing Ad containing any kind of misleading information.</li>
				<li>Listing Ad with hateful information or remarks</li>
			</ol>
			<h2 style="color:#337AB7;"><b>Help & Support</b></h2><hr/>
			<h3>F&Q</h3>
			<h4>1. How do I post an Ad?</h4>
			<p>Ans. Click on the <a href="{{url('/post')}}" class="btn btn-success btn-sm">Post Ad</a> button<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Select the type of category<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Enter the details like Title, Description and all other details<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Enter your email address, phone number<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	click on Post Ad option<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	If you want to run paid ads to get good ranking and posting, you can refer our paid plans and choose from there<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	Check your email for confirmation of Ad approval</p>
				<br/>
			<h4>2. What are the safety rules for me?</h4>
			<p>Ans. Tips for staying safe<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;1. Before buying or selling, make sure you meet the person face to face and do enough inspection regarding the seller or buyer <br/>
					&nbsp;&nbsp;&nbsp;&nbsp;2. Never send the product before getting the money<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;3. Never send money online <br/>
					&nbsp;&nbsp;&nbsp;&nbsp;4. Address Guru Singapore does not offer any Customer/seller protection<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;5. Take full care of delicate products<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;6. Never provide personal or banking information to anybody<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;7. Be aware of common fraud or scam activities<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;8. Report us if you face any kind of fraudulent activity</p><br/>
		</div>
	</div>
</div>


@stop