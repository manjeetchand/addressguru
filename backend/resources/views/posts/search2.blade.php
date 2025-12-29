<!DOCTYPE html>
<html lang="en">
<head>

@extends('layouts.app')
<title>List of Top {{count($data)}} {{$category->name}} in {{$city}} | Address Guru</title>
    <meta name="description" content="List of top {{count($data)}} best {{$category->name}} in {{$city}} {{$category->des}} in {{$city}}">
    <meta name="keywords" content="List of {{count($data)}} {{$category->name}} in {{$city}}, {{count($data)}} best {{$category->name}} in {{$city}}, top {{count($data)}} {{$category->name}} in {{$city}}, Get contact details of {{count($data)}} {{$category->name}} in {{$city}}">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="List of Top {{count($data)}} {{$category->name}} in {{$city}} | Address Guru" />
    <meta property="og:description" content="List of top {{count($data)}} best {{$category->name}} in {{$city}} {{$category->des}} in {{$city}}" />
    <meta property="og:site_name" content="Address Guru" />
    <meta property="og:image" content="/images/address.png" />
    <meta property="og:locale" content="en_US" />
    <meta name="twitter:text:title" content="List of Top {{count($data)}} {{$category->name}} in {{$city}} | Address Guru" />
    <meta name="twitter:image" content="/images/address.png" />
    <meta name="twitter:card" content="List of Top {{count($data)}} {{$category->name}} in {{$city}} | Address Guru" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "WebSite",
    "name": "Address Guru",
    "url": "https://www.addressguru.sg"
}
</script>
<script type="application/ld+json">
{
  "@context":"http://schema.org",
  "@type":"WebPage","aggregateRating":
  {
    "@type":"AggregateRating",
    "ratingValue":"4.5",
    "reviewCount":"1259",
    "bestRating":"5",
    "worstRating":"0",
    "itemReviewed":"{{$category->name}}Review"
  }
}
</script>
<script type="application/ld+json">
{   
  "@context": "http://schema.org",
    "@type": "ItemList",
    "itemListElement" : 
    [
    <?php $co = 1; $myArray = array(); ?>
    @foreach($data as $key => $value)
      @if(isset($value[0]))
      
      <?php 
        if ($value[0]->category->id == 52) 
        {
          $myArray[] = '{
        "@type":"ListItem",
        "position":'.$co.',
        "url":"https://www.addressguru.sg/profiles/'.$value[0]->slug.'"
        }';
        }
        else
        {
            $myArray[] = '{
        "@type":"ListItem",
        "position":'.$co.',
        "url":"https://www.addressguru.sg/profiles/'.$value[0]->slug.'"
        }';
        }

        ?>
      @endif
      <?php $co++; ?>
    @endforeach
    <?php echo implode( ', ', $myArray ); ?>
    ]     
 }
</script>
<script type="application/ld+json">
[
  {
    "@context":"http://schema.org",
    "@type":"Organization",
    "name":"addressguru.in",
    "url":"https://www.addressguru.sg",
    "logo":"https://www.addressguru.sg/images/logopng.png",
      "sameAs":
    [ "https://www.facebook.com/addressguru.in/",
            "https://www.youtube.com/channel/UC8WEXsO-s9N-ncxX4AVUH4Q",
            "https://twitter.com/AddressGuru",
            "https://www.instagram.com/addressguru/"]
  }
]
</script>
@section('content')

	@include('posts.new')
	

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 14000);
}
</script>
@stop