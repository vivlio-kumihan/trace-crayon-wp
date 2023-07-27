<?php /* Template Name: お問い合わせ */ ?>

<?php get_header(); ?>

<div class="frame-archive-top">
  <h1 class="section-title"><span lang="en">CONTACT</span><br><span lang="ja">お問い合わせ</span></h1>
  <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
    <?php if (function_exists('bcn_display')) {
      bcn_display();
    } ?>
  </div>
  <img src="<?php echo get_template_directory_uri(); ?>/img/00-page-contact-bg-mv-bg.jpg" alt="">
</div>

<section class="contact-page">
  <p class="lead">
    くれよんに興味を持っていただきありがとうございます。<br>
    電気のことでお困りの方。電気工事士の仕事に興味がある方。<br>
    お気軽にご相談ください。お電話での問い合わせも受け付けています。
  </p>

  <div class="call-tel"><span class="eye-catch">TEL</span>0721-23-5658</div>
  <div class="office-hours">
    受付時間&nbsp;/&nbsp;平日<time datetime="08:00">8:00</time><span class="hyphone">&nbsp;-&nbsp;</span><time datetime="17:30">17:30</time>
  </div>

  <div class="contact-container">
    <ul class="process">
      <li><span lang="en">1</span><br>入力</li>
      <li><span lang="en">2</span><br>確認</li>
      <li><span lang="en">3</span><br>送信</li>
    </ul>

    <!-- WPのコンタクトフォームを挿入 -->
    <?php echo do_shortcode('[contact-form-7 id="174" title="contact-form"]') ?>

    <!--
    <dl class="contact-form">
      <div class="input-radio">
        <dt>お問い合わせの区分<span>必須</span></dt>
        <dd>
          [checkbox* about-contact "電気工事について" "採用について" "その他お問合せ"]
        </dd>
      </div>
      <div>
        <dt>お名前<span>必須</span></dt>
        <dd>[text* sender placeholder "山田太郎"]</dd>
      </div>
      <div>
        <dt>フリガナ<span>必須</span></dt>
        <dd>[text* ruby placeholder "ヤマダタロウ"]</dd>
      </div>
      <div>
        <dt>メールアドレス<span>必須</span></dt>
        <dd>[email* email placeholder "sample@yahoo.co.jp"]</dd>
      </div>
      <div>
        <dt>電話番号<span>必須</span></dt>
        <dd>[tel* tel placeholder "000-000-0000（ハイフンなしでも可）"]</dd>
      </div>
      <div class="input-radio">
        <dt>希望連絡手段<span class="optional">任意</span></dt>
        <dd>
          [checkbox* tool "メール" "電話"]
        </dd>
      </div>
      <div>
        <dt>会社名<span class="optional">任意</span></dt>
        <dd>
          [text company placeholder "会社名が入ります"]
        </dd>
      </div>
      <div class="address">
        <dt>住所<span class="optional">任意</span></dt>
        <dd>
          <div>
            <label for="postal-code">〒</label>
            [text postal-cod placeholder "（例）123-4567"]
          </div>
          [text address placeholder "住所が入ります"]
        </dd>
      </div>
      <div>
        <dt>お問い合わせ内容<span>必須</span></dt>
        <dd>
          [text* contents]
        </dd>
      </div>
    </dl>
    <div class="agreement">
      <p><span class="under-line">プライバシーポリシー</span>に同意の上、送信してください。</p>
      <div>
        [radio agreement "プライバシーポリシーに同意する"]
        <label for="agreement">プライバシーポリシーに同意する</label>
      </div>
      <button>[submit "内容確認"]</button>
    </div> 
    -->

  </div>
</section>

<section id="contact" class="contact">
  <p>電気のことでお困りの際は<br class="for-sp">気軽にご相談ください</p>
  <a href="">電気工事のご依頼・ご相談はこちら</a>
  <ul>
    <li lang="en">0721-23-5658</li>
    <li><span>受付時間</span>&emsp;平日&nbsp;<span lang="en"><time datetime="09:00">9:00&thinsp;-&thinsp;<time datetime="17:00"></time>17:00</span></li>
  </ul>
</section>

<?php get_footer(); ?>