<?php
/*
Plugin Name: WG Dynamic Custom Slider
Plugin URI: https://www.iwangoweb.com/
Description: 動態投影片輪播短碼，使用者可選擇3~5個圖片並於前台顯示投影片輪播。
Version: 1.3
Author: 玩構網路
Author URI: https://www.iwangoweb.com/about/
*/


/*建立圖片網址變數，總共有5張*/
$image_url_1 = "";
$image_url_2 = "";
$image_url_3 = "";
$image_url_4 = "";
$image_url_5 = "";

function display_dynamic_slider(){
/*全域變數宣告*/
global $image_url_1, $image_url_2, $image_url_3, $image_url_4, $image_url_5;

/*查詢post type diet*/
$query_string = array(
	'post_type' => 'diet',
	'posts_per_page' => 1,
	'orderby' => 'title',
	'order' => 'asc'
);
$acf = new WP_Query($query_string);

if($acf->have_posts()) {
	while($acf->have_posts()){
		$acf->the_post();
		$image_url_1 = get_field('圖片1');
		$image_url_2 = get_field('圖片2');
		$image_url_3 = get_field('圖片3');
		$image_url_4 = get_field('圖片4');
		$image_url_5 = get_field('圖片5');
	}
}

wp_reset_postdata();

/*傳回前端 HTML*/
return "
<div id='carouselExampleControls' class='carousel slide' data-ride='carousel' data-interval='2000'>
<div class='carousel-inner'>
<div class='carousel-item active'>
<img class='d-block w-100' src='".$image_url_1."' alt='First slide'>
</div>
<div class='carousel-item'>
<img class='d-block w-100' src='".$image_url_2."' alt='Second slide'>
</div>
<div class='carousel-item'>
<img class='d-block w-100' src='".$image_url_3."' alt='Third slide'>
</div>
<div class='carousel-item'>
<img class='d-block w-100' src='".$image_url_4."' alt='4th slide'>
</div>
<div class='carousel-item'>
<img class='d-block w-100' src='".$image_url_5."' alt='5th slide'>
</div>
</div>
<a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
<span class='carousel-control-prev-icon' aria-hidden='true'></span>
<span class='sr-only'>Previous</span>
</a>
<a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
<span class='carousel-control-next-icon' aria-hidden='true'></span>
<span class='sr-only'>Next</span>
</a>
</div>
";
}
add_shortcode('dynamic_slider', 'display_dynamic_slider');

function add_css_cdn(){
/*引入 bootstrap css cdn*/
echo "
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css' integrity='sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l' crossorigin='anonymous' type='text/css' media='all' />
";
}
add_action('wp_head', 'add_css_cdn');

function add_js_cdn(){
/*引入 bootstrap js cdn*/
echo "
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns' crossorigin='anonymous'></script>
";
}
add_action('wp_footer', 'add_js_cdn');
?>