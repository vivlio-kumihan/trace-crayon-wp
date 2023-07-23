<ul class="post-categories">
  <?php
  // 『the_category()』を配列にして出力すには、
  // 『get_the_category()関数』を使う。
  // 『the_category()』の属性が配列として取れた。
  $category = get_the_category();
  // name属性をキーにして値を取り出す。
  foreach ($category as $attr) {
    echo '<li>' . $attr->name . '</li>';
  }
  ?>
</ul>