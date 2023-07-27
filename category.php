<div class="container">
  <div class="contents">
    <!-- 投稿の一覧ページの`カテゴリー`をクリックするとこのページに飛ぶようにデフォルトで紐づけられている。
    このページ自体が『選択した`カテゴリー`』の`インスタンス`である、それに対する関数を`WP`は定義している。
    それらを使って欲しい情報を適宜出力してページにレイアウトすると考える。 -->
    <!-- 『single_cat_title()』関数でカテゴリー名を出力する。 -->
    <h1><?php single_cat_title(); ?>カテゴリーの一覧</h1>
    <dl>
      <?php // ページ番号を取得する。1ページ目は『0』になるので条件節で変換する。
      $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;
      // 現在カテゴリーの情報を『get_the_category()』関数で引き出す。
      $category = get_the_category();
      // $categoryはオブジェクトで値は一つだけなのでインデックス[0]と特定して呼び出す。
      // キー『slug（url）』に紐づいた値＝現在いるカテゴリーの名称を引き出すという流れ。
      // var_dump($category[0]->slug);
      // var_dump($category[0]);
      $args = array(
        // これはカスタム投稿じゃないからデフォルトのまま。なお省略可能。
        // 'post_type' => 'post',
        // 現在のカテゴリーをslug（url）にして変数に格納する。
        'category_name' => $category[0]->slug,
        // 『-1』は、あるだけ全部出してという意味
        'posts_per_page' => -1,
        // このインスタンスで定義された変数。現在のカテゴリーに対して現在のページ番号が格納されてる。
        'paged' => $recent_page
        // オプションが多数あり、下記参照。
        // 'orderby' => 
      );
      $my_query = new WP_Query($args); ?>

      <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
          <a href="<?php the_permalink(); ?>">
            <dt><?php the_title(); ?></dt>
            <dd><?php the_excerpt(); ?></dd>
          </a>
        <?php endwhile; ?>
      <?php endif; ?>
    </dl>

    <!-- パンくずリスト -->
    <!-- このリストもWPが構造を書き出す。それに合わせてスタイルをつける。 -->
    <?php
      $args = array(
        'type' => 'list',
        'current' => $recent_page,
        // 現在のインスタンス、つまり全ページの総数を変数に格納している。
        'total' => $my_query->max_num_pages,
        // 記号は適宜
        'prev_text' => '<',
        'next_text' => '>'
      );
      // 『paginate_links()』関数の1行でパンくずリストを出力してる。
      echo paginate_links($args);
    ?>
  </div>
</div>


<!-- WordPressのWP_Queryでよく使うコードスニペット -->
<?php
$args = array(
  // 特定の「著者」に関連付けられた投稿を表示する場合
  'author' => '1,2,3',                       // 著者IDを指定
  'author_name' => 'solecolor',              // user_nicenameを指定（名前ではありません）
  'author__in' => array(2, 6),            // 著者IDを配列で指定（著者IDを含む記事を絞り込む）
  'author__not_in' => array(2, 6),        // 著者IDを配列で指定（著者IDを含まない記事を絞り込む）

  // 特定の「カテゴリー」に関連付けられた投稿を表示する場合
  'cat' => 5,                                // カテゴリーIDを指定
  'category_name' => 'daily, news',          // カテゴリースラッグを指定（複数の場合は「,」で区切る）
  'category__and' => array(2, 6),         // カテゴリーIDを配列で指定（カテゴリーIDを含む記事を絞り込む）
  'category__in' => array(2, 6),          // カテゴリーIDを配列で指定（カテゴリーIDを含む記事を絞り込む）
  'category__not_in' => array(2, 6),      // カテゴリーIDを配列で指定（カテゴリーIDを含まない記事を絞り込む）

  // 特定の「タグ」に関連付けられた投稿を表示する場合
  'tag' => 'cooking',                        // タグスラッグを指定
  'tag_id' => 5,                             // タグIDを指定
  'tag__and' => array(2, 6),              // タグIDを配列で指定（タグIDを含む記事を絞り込む）
  'tag__in' => array(2, 6),               // タグIDを配列で指定（タグIDを含む記事を絞り込む）
  'tag__not_in' => array(2, 6),           // タグIDを配列で指定（タグIDを含まない記事を絞り込む）
  'tag_slug__and' => array('red', 'blue'), // タグスラッグを配列で指定（タグスラッグを含む記事を絞り込む）
  'tag_slug__in' => array('red', 'blue'),  // タグスラッグを配列で指定（タグスラッグを含む記事を絞り込む）

  // 特定の「タクソノミー」に関連付けられた投稿を表示する場合（以下は複数のタクソノミーにてAND検索）
  'tax_query' => array(                    // タクソノミーパラメーターを指定
    'relation' => 'AND',                   // タクソノミーの検索条件に 'AND' か 'OR' が使用可能
    array(
      'taxonomy' => 'color',             // タクソノミーを指定
      'field' => 'slug',                 // term_id(デフォルト),name,slug のいずれかのタームの種類を選択
      'terms' => array('red', 'blue'), // ターム(文字列かIDを指定)
      'include_children' => true,        // 階層を持つタクソノミーの場合に、子孫タクソノミーを含めるかどうか
      'operator' => 'IN'                 // 演算子'IN','NOT IN','AND','EXISTS'(4.1.0以降),'NOT EXISTS'(4.1.0以降)が利用可能
    ),
    array(
      'taxonomy' => 'actor',
      'field' => 'id',
      'terms' => array(103, 115, 206),
      'include_children' => false,
      'operator' => 'NOT IN'
    )
  ),

  // 特定の「投稿＆固定ページ」に関連付けられた投稿を表示する場合
  'p' => 1,                                   // 投稿IDを指定
  'name' => 'hello-world',                    // 投稿スラッグを指定
  'page_id' => 1,                             // 固定ページのIDを指定
  'pagename' => 'sample-page',                // ページスラッグを指定
  'pagename' => 'contact_us/canada',          // 子ページを表示する場合、スラッシュ区切りで親と子のスラッグを指定
  'post_parent' => 1,                         // ページIDを指定した子ページを表示
  'post_parent__in' => array(1, 2, 3),      // 配列の親ページIDを含む投稿を表示
  'post_parent__not_in' => array(1, 2, 3),  // 配列の親ページIDを含まない投稿を表示
  'post__in' => array(1, 2, 3),             // 配列の投稿IDを含む投稿を表示
  'post__not_in' => array(1, 2, 3),         // 配列の投稿IDを含まない投稿を表示

  // 特定の「パスワード」に関連付けられた投稿を表示する場合
  'has_password' => true,                     // パスワード付きの投稿を表示( true or false )
  'post_password' => 'zxcvbn',                // 特定のパスワードが付いた投稿を表示

  // 特定の「タイプ」に関連付けられた投稿を表示する場合
  'post_type' => array(
    'post',               // 投稿
    'page',               // 固定ページ
    'revision',           // リビジョン
    'attachment',         // 添付ファイル
    'custom-post-type'    // カスタム投稿タイプ
  ),
  'post_type' => 'any',   // すべてのタイプを含めて表示(リビジョンと'exclude_from_search'がtrueにセットされたものを除く)

  // 特定の「投稿ステータス」に関連付けられた投稿を表示する場合
  'post_status' => array( // 投稿ステータスを指定 (デフォルト'publish')        
    'publish',            // 公開された投稿、または固定ページを表示
    'pending',            // レビュー待ちの投稿を表示
    'draft',              // 下書きの投稿を表示
    'auto-draft',         // コンテンツのない、新しく作成された投稿を表示
    'future',             // 予約公開設定された投稿を表示
    'private',            // ログインしていないユーザーには見えない投稿を表示
    'inherit',            // リビジョンを表示
    'trash',              // ゴミ箱に入った投稿を表示
  ),
  'post_status' => 'any', // すべてのステータスを表示(投稿タイプで'exclude_from_search'がtrueにセットされたものを除く)

  // ページ送りパラメーターを設定する場合
  'posts_per_page' => 10,            // 1ページあたりに表示する投稿数を指定(-1を指定するとすべての投稿を表示)
  'posts_per_archive_page' => 10,    // 1ページあたりに表示する投稿数(アーカイブページのみ)
  'nopaging' => false,               // ページ送りを使用するか、すべての投稿を表示するか、(デフォルトはfalseでページ送りを使用)
  'paged' => 6,                      // ページ番号6の記事を表示
  'paged' => get_query_var('paged'), // 現在のページから投稿を表示
  'offset' => 3,                     // 設定した数だけ、ずらして表示(例では4番目の投稿から表示)
  'ignore_sticky_posts' => false,    // 先頭固定表示投稿を無視するかどうか(デフォルト値は0で先頭固定表示投稿を無視しない)

  // 「投稿の並び順」を指定する場合
  'order' => 'DESC',    // 'ASC' 昇順  (1, 2, 3; a, b, c)
  // 'DESC' 降順 (3, 2, 1; c, b, a)

  'orderby' => 'date',  // デフォルト値'date' 複数のオプションを渡すことが可能
  // 例：'orderby' => 'menu_order title'
  // その他のオプション ↓
  //'none'     並び替えなし
  //'ID'       投稿IDで並び替え
  //'author'   著者で並び替え
  //'title'    タイトルで並び替え
  //'name'     Order by post name(post slug)
  //'modified' 更新日で並び替え
  //'parent'   親ページIDで並び替え
  //'rand'     ランダム順
  //'comment_count'   コメント数で並び替え
  //'menu_order'      ページの表示順で並び替え
  //'meta_value'      アルファベット順で並び替え(数値ではうまくいかない)
  //'meta_value_num'  数値で並び替え
  //'post__in'        post__inで配列で指定された投稿IDの並び順を維持して表示

  // 特定の「時間や日付の期間」に関連付けられた投稿を表示する場合
  'year' => 2015,       // 4桁の年を数字で指定(2015など)
  'monthnum' => 4,      // 月を数字で指定( 1～12 )
  'w' =>  25,           // 年内の週を数字で指定( 0～53 )
  'day' => 17,          // 月内の日を数字で指定( 1～31 )
  'hour' => 13,         // 時間を数字で指定（ 0～23 ）
  'minute' => 19,       // 分を数字で指定( 0～60 )
  'second' => 30,       // 秒を数字で指定( 0～60 )
  'm' => 201404,        // 年と月を数字で指定 ( 201508など )

  // 「○年○月○日から○年○月○日の範囲の投稿情報」を表示する場合(投稿日の検索が自由自在!)
  'date_query' => array(
    array(
      'year' => 2015,                 // 4桁の年を数字で指定(2015など)
      'month' => 8,                   // 月を数字で指定( 1～12 )
      'week' => 31,                   // 年内の週を数字で指定( 0～53 )
      'day' => 5,                     // 月内の日を数字で指定( 1～31 )
      'hour' => 2,                    // 時間を数字で指定（ 0～23 ）
      'minute' => 3,                  // 分を数字で指定( 0～60 )
      'second' => 36,                 // 秒を数字で指定( 0～60 )
      'after' => 'January 1st, 2013', // 指定した日付以降の投稿を取得。strtotime()と互換性のある文字列で'after'=>'2015/08/31'などでもOK
      'before' => array(              // 指定した日付以前の投稿を取得。strtotime()と互換性のある文字列で'before'=>'2015/08/31'などでもOK
        'year'  => 2013,          // 4桁の年を数字で指定(2015など) デフォルトは空
        'month' => 2,             // 年内の月を数字で指定( 1～12 ) デフォルトは12
        'day'   => 28,            // 月内の日を数字で指定( 1～31 ) デフォルトは月内の末日
      ),
      'inclusive' => true,            //「after」または「before」パラメーターで指定された値を含むかどうか
      'compare' => '=',               // 使用可能な値は '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' , and 'NOT EXISTS'
      'column' => 'post_date',        // 照会するカラムを指定。デフォルトは「post_date」
      'relation' => 'AND',            // OR または AND デフォルトは「AND」
    ),
  ),

  // 特定の「カスタムフィールド」に関連付けられた投稿を表示する場合
  'meta_key' => 'key',     // カスタムフィールドのキーを指定
  'meta_value' => 'value', // カスタムフィールドの値を指定
  'meta_value_num' => 10,  // カスタムフィールドの値を指定
  'meta_compare' => '=',   //「meta_value」をテストする演算子。使える値は'!='、'>'、'>='、'<'、'=' デフォルト値は'='
  'meta_query' => array( // カスタムフィールドパラメーター
    'relation' => 'AND',     // 「AND」または「OR」を指定。meta_query内の配列が「2つ以上」の場合に限る。meta_query配列が1つの場合は使用しない。
    array(
      'key' => 'color',    // カスタムフィールドのキー。
      'value' => 'blue',   // カスタムフィールドの値 (注意 compareの値が'IN'、'NOT IN'、'BETWEEN'、'NOT BETWEEN'のみ配列をサポート)
      'type' => 'CHAR',    // カスタムフィールドタイプ。タイプについては以下の「meta_queryで使えるデータ型」参照
      'compare' => '=',    // 演算子を指定 デフォルト値は'=' 演算子の種類については以下「meta_queryで指定できる演算子の種類」参照
    ),
    array(
      'key' => 'price',
      'value' => array(1, 200),
      'compare' => 'NOT LIKE',
    )
  ),

  // 適切な権限を持っているユーザーのプライベートの記事を表示する場合
  'perm' => 'readable',     // 使える値は’readable’と’editable’

  // キャッシュ系のパラメーター
  'cache_results' => true,           // 投稿情報をキャッシュするかどうか デフォルトはtrue
  'update_post_term_cache' => true,  // 投稿タームキャッシュを更新するかどうか デフォルトはtrue
  'update_post_meta_cache' => true,  // 投稿メタキャッシュを更新するかどうか デフォルトはtrue
  'no_found_rows' => false,          // カウントをスキップする？ tureでパフォーマンスが向上する可能性があるかも デフォルトはfalse

  // 検索系のパラメーター
  's' => $s, // 検索からクエリーストリング値を渡します。 
  'exact' => true, //タイトル／投稿の全体から正確なキーワードで検索するか デフォルト値はfalse
  'sentence' => true, //語句(フレーズ検索)で検索するか デフォルト値はfalse

  // 投稿フィールドパラメーター
  'fields' => 'ids' //１つのフィールドで返すか全てのフィールドで返すか デフォルトでは全てのフィールドが返される
  // 使用できる値
  // 'ids' 投稿のIDの配列を返します
  // 'id=>parent' 連想配列を返します
);

$query = new WP_Query($args);

if ($the_query->have_posts()) :
  while ($the_query->have_posts()) : $the_query->the_post();
  // 何かしらの処理
  endwhile;
endif;

// 投稿データのリセット
wp_reset_query();
?>