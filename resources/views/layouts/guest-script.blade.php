<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

	<title>Ekmatra</title>

	<meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
	<meta name="description" content="ekmatra">
	<meta name="author" content="D-THEMES">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{url('front/images/icons/favicon.png')}}">
	<link href="{{url('backend/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

	<script src="{{url('front/vendor/jquery/jquery.min.js')}}"></script>

	<!-- WebFont.js -->
	<script>
		WebFontConfig = {
			google: { families: ['Poppins:400,500,600,700,800','Jost:400,500,600,700,800'] }
		};
		(function (d) {
			var wf = d.createElement('script'), s = d.scripts[0];
			wf.src = "{{url('front/js/webfont.js')}}";
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
		})(document);
	
			
		
	</script>

	 <link rel="preload" href="{{url('front/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
		crossorigin="anonymous">
	<link rel="preload" href="{{url('front/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
		crossorigin="anonymous">
	<link rel="preload" href="{{url('front/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
			crossorigin="anonymous">
	<link rel="preload" href="{{url('front/fonts/wolmart87d5.ttf?png09e')}}" as="font" type="font/ttf" crossorigin="anonymous">

	<!-- Vendor CSS -->
	<link rel="stylesheet" type="text/css" href="{{url('front/vendor/fontawesome-free/css/all.min.css')}}">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="{{url('front/vendor/swiper/swiper-bundle.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('front/vendor/animate/animate.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('front/vendor/magnific-popup/magnific-popup.min.css')}}">

	<!-- Default CSS -->
     @if(request()->is('/') || request()->is('shop/*') || request()->is('search') ||  request()->is('shop-by/*'))
     	 <link rel="stylesheet" type="text/css" href="{{url('front/css/demo12.min.css')}}"> 
     
     @else
     		    <link rel="stylesheet" type="text/css" href="{{url('front/css/style.min.css')}}">

     @endif

	
</head>
<style type="text/css">
	.product-image-gap .product-media {
    max-width: 295px;
    max-height: 300px;
    width: 100%;
    height: 225px;
	}
.product-image-gap .product-media img {
    object-fit: cover;
}
	.menu > li:hover > .submenu, .menu > li:hover .megamenu, .menu > li.show > .submenu, .menu > li.show .megamenu {
    top: 0 !important;
	}
	.main-nav .menu > .has-submenu ul.submenu {
    top: 100% !important;
	}
	li.shopby.has-submenu:hover ul.megamenu {
    top: 100% !IMPORTANT;
}

	.error{
		color:#a94442;
	}

	/* 12 April wishlist  */
.shop-table.cart-table th {
text-align: left;
}
.wishlistbtns {
    display: flex;
    align-items: center;
}

.wishlistbtns .removewishlist{
	width: 40px;
    height: 40px;
    border: none;
    background-color: transparent;
}
.wishlistbtns .edit{
	width: 40px;
    height: 40px;
    border: none;
    background-color: transparent;
}

.wishlistbtns .save {
	width: 40px;
    height: 40px;
    border: none;
    background-color: transparent;
}

.wishlistbtns .close {
	width: 40px;
    height: 40px;
    border: none;
    background-color: transparent;
    margin-left: 15px;
}
.newsletterdiv{
max-width: 300px;
box-shadow: 0 0 30px rgba(0,0,0,.15);
background: #fff;
width: 100%;
display:block;
padding:20px;
}

.newsletterdiv .mfp-close::before {
    content: "";
    display: block;
    position: absolute;
    width: 2px;
    height: 100%;
    top: 0;
    left: calc(50% - 1px);
    background-color: #000;
}

.newsletterdiv .mfp-close::after {
    width: 100%;
    height: 2px;
    top: calc(50% - 1px);
    left: 0;
    background-color: #000;
}

.newsletterdiv .mfp-close {
    width: 18px;
    height: 18px;
    -webkit-transform: rotateZ(45deg) scale(1);
    transform: rotateZ(45deg) scale(1);
    top: 10px;
    right:10px;
    left: auto;
    opacity: 1;
    -webkit-transition: -webkit-transform 0.3s;
    transition: -webkit-transform 0.3s;
    transition: transform 0.3s;
    transition: transform 0.3s, -webkit-transform 0.3s;
}

.newsletterdiv span.cg-wishlist__cta__toggle.quantity-plus.w-icon-plus.addlist {
    border: 2px solid #760000;
    border-radius: 50%;
    display: flex;
    color: #760000;
    font-size: 15px;
    width: 25px;
    height: 25px;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}
h4.product-name.wishlist-title{
	margin-bottom: 0.7rem;
    font-size: 1.3rem;
    font-weight: 500;
    overflow: hidden;
    text-overflow: ellipsis;
    word-wrap: break-word;
}

@media screen and (max-width: 767px) {
	.newsletterdiv{
	padding:20px;
	margin:0 auto;
	min-height: auto;
	}

	.newsletterdiv .newsletter-content {
    max-width: 100%;
    text-align: left;
}

.newsletter-popup .form-checkbox {
    -webkit-box-pack: flex-start;
    -ms-flex-pack: flex-start;
    justify-content: flex-start !important;
}
}

</style>