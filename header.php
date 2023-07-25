<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php add_theme_support('title-tag'); ?></title>
  <!-- <title>TK | 株式会社くれよん | 大阪の電気工事会社</title> -->
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/desvg@1.0.2/mob.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.1/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.1/ScrollTrigger.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <?php wp_head(); ?>
</head>

<body <?php echo body_class(); ?>>
  <div id="loading" class="loading keep">
    <!-- ロゴ　白い線画 -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 325.5 325.5">
      <style>
        .logo_svg {
          fill: none;
          stroke: #fff;
          stroke-miterlimit: 10;
          stroke-width: 2px;
        }
      </style>
      <rect class="outer_frame" x=".25" y=".25" width="325" height="325"></rect>
      <polygon class="logo_svg" points="266.48 235.65 251.37 235.61 238.65 267.74 253.59 267.74 266.48 235.65"></polygon>
      <polygon class="logo_svg" points="234.45 251.56 234.33 204.58 211.66 204.59 201.64 220.05 219.55 220.12 219.55 267.7 235.17 267.74 241.63 251.6 234.45 251.56">
      </polygon>
      <polygon class="logo_svg" points="187.33 122.79 187.35 153.08 202.14 153.08 202.18 109.43 187.33 122.79"></polygon>
      <polygon class="logo_svg" points="266.48 153.08 266.47 107.66 251.63 107.59 251.63 139.06 247.85 139.05 247.66 66.59 223.6 66.56 160.16 123.07 170.36 133.34 226.68 82.86 232.67 82.9 232.65 153.08 266.48 153.08">
      </polygon>
      <polygon class="logo_svg" points="202.81 56.58 187.36 56.52 187.27 94.83 202.64 80.6 202.81 56.58"></polygon>
      <polygon class="logo_svg" points="150.32 249.48 121.05 228.03 121.05 245.37 141.64 261.09 150.32 249.48"></polygon>
      <rect class="logo_svg" x="121.05" y="183.88" width="29.27" height="14.84"></rect>
      <polygon class="logo_svg" points="80.75 102.41 67.76 93.51 118.4 52.37 130.15 61.87 80.75 102.41"></polygon>
      <polygon class="logo_svg" points="65.46 96.11 65.21 113.27 122.27 154.8 132.02 143.01 65.46 96.11"></polygon>
      <rect class="logo_svg" x="165.99" y="74.24" width="17.86" height="14.84"></rect>
      <path class="logo_svg" d="M102.7,170.84v53.74H59.02v45.16h58.57v-98.91h-14.89Zm0,84.01h-28.79v-15.38h28.79v15.38Z">
      </path>
      <path class="logo_svg" d="M163.89,273.12l16.43-53.62h-13.53l17.41-48.66,21.83,.04-13.29,32.58h15.95l-44.82,69.66Zm7.02-56.57h13.52l-13.14,39.57,32.09-49.72h-14.9l13.29-32.59-15.45-.03-15.4,42.77Z">
      </path>
    </svg>
    <!-- ロゴ　元画像 -->
    <img class="org_logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="株式会社くれよんのロゴ">
  </div>
  <div id="main" class="main">
    <header>
      <figure class="ci">
        <a href="<?php echo home_url('/') ?>">
          <img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="株式会社くれよんのロゴ"></img>
        </a>
        <figcaption class="catch-copy">電気工事業界を<br>色めく仕事に</figcaption>
      </figure>
      <?php
        wp_nav_menu(array(
          'theme_location' => 'nav-link'
        ))
      ?>
      <button id="content-links-btn" class="content-links-btn">
        <div></div>
        <div></div>
        <div></div>
        MENU
      </button>
      <div id="menu-link" class="menu-link">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'menu-link'
        ))
        ?>
        <a class="contact" href="">
          <p>お問い合わせ</p>
        </a>
        <ul class="other-links">
          <li><a class="shrinkLine" href="">プライバシーポリシー</a></li>
          <li>
            <a class="icon twitter" href=""></a>
            <a class="icon instagram" href=""></a>
          </li>
        </ul>
      </div>
    </header>