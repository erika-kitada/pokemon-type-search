<!DOCTYPE html>
<?php
if(isset($_GET['lang'])){
  $lang = $_GET['lang'];
}
if(isset($_GET['lang'])){
  if($lang == "en"){
    echo '<html lang="en">';
  } else {
    echo '<html lang="zh-cmn-Hans">';
  }
} else {
  echo '<html lang="ja">';
}
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pokemon Document</title>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="./lib/jquery-ui.min.js"></script>
  <?php
if(isset($_GET['lang'])){
  $lang = $_GET['lang'];
}
if(isset($_GET['lang'])){
  if($lang == "en"){
    echo '<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">';
  } else {
    echo '<link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC&display=swap" rel="stylesheet">';
  }
} else {
  echo '<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">';
}
?>
<style>
/* init */
html {font-size: 62.5%;}
body {font-family: sans-serif;}
* {
  margin: 0;
  padding: 0;
  font-size:1.6rem;
  box-sizing: border-box;
}
ul, ol {list-style-type: none;}
a {color: inherit;}
/* overwrite jquery ui autocomplete */
.ui-autocomplete {top: 3.5em;left: 0.5em;}
.ui-state-active,
.ui-widget-content .ui-state-active,
.ui-widget-header .ui-state-active {
	border: 1px solid #ddd;
	background: #ffffff;
  color: #666;
  font-weight: normal;
}
.ui-state-active a,
.ui-state-active a:link,
.ui-state-active a:visited {
	color: #666;
	text-decoration: none;
}
/* form */
legend {margin: 0.5rem 0;}
form { padding: 1rem; }
fieldset {border: none;}
#autocomplete_search,
.search_button {
  border: 1px solid #666;
  border-radius: 4px;
  -webkit-appearance : none;
}
#autocomplete_search {
  font-size: 1.6rem;
  padding: .7rem;
}
.search_button {
  padding: .5rem .7rem;
  background-color: #eee;
}
.result {
  margin-top: 0.5rem;
  margin-left: 1rem;
}
.navi--lang {
  margin-top: 1rem;
  margin-left: 1rem;
  display: flex;
}
.navi--lang > li {
  flex-basis: 7rem;
  text-align: center;
  color:#333;
}
</style>
</head>
<body>
<nav>
  <ul class="navi--lang">
    <li><a href="/pokemon-type/">Japan</a></li>
    <li><a href="/pokemon-type/?lang=en">English</a></li>
    <li><a href="/pokemon-type/?lang=cn">Chinese</a></li>
  </ul>
</nav>
<form>
<?php
$searchBixJa = <<< EOM
  <fieldset>
    <legend><span class="js-lang--ja">ポケモンのタイプをしらべる</span></legend>
    <div>
      <label for="autocomplete_search">
        <input type="search" id="autocomplete_search">
      </label>
      <button type="button" class="search_button"><span class="js-lang--ja">しらべる</span></button>
    </div>
  </fieldset>
EOM;

$searchBixEn = <<< EOM
  <fieldset>
    <legend><span class="js-lang--en">Find out the type of Pokemon</span></legend>
    <div>
      <label for="autocomplete_search">
        <input type="search" id="autocomplete_search">
      </label>
      <button type="button" class="search_button"><span class="js-lang--en">Search</span></button>
    </div>
  </fieldset>
EOM;

$searchBixCn = <<< EOM
  <fieldset>
    <legend><span class="js-lang--cn">
      找出口袋妖怪的类型</span></legend>
    <div>
      <label for="autocomplete_search">
        <input type="search" id="autocomplete_search">
      </label>
      <button type="button" class="search_button"><span class="js-lang--cn">
        搜索</span></button>
    </div>
  </fieldset>
EOM;

if(isset($_GET['lang'])){
  $lang = $_GET['lang'];
}
if(isset($_GET['lang'])){
  if($lang == "en"){
    echo $searchBixEn;
  } else {
    echo $searchBixCn;
  }
} else {
  echo $searchBixJa;
}
?>
  <div class="result"></div>
</form>
<script type="text/javascript">
// suggest setting
var dataList = [
  ['フェアリー', 'ふぇありー'],
  ['炎', 'ほのお'],
  ['水', 'みず']
];

$(function(){
  // suggest
  $('#autocomplete_search').autocomplete({
    source: function(request, response){
      var suggests = [];
      var regexp = new RegExp('(' + request.term + ')');
      
      jQuery.each(dataList, function(i, values){
        if(values[0].match(regexp) || values[1].match(regexp)){
          suggests.push(values[0]);
        }
      });
      
      response(suggests);
    },
    autoFocus: true,
    delay: 300,
    minLength: 1
  });

  // result
$('.search_button').on('click', function(){
  const pokemonType = $('#autocomplete_search').val();
  switch (pokemonType){
    case 'フェアリー':
    const text1 = `<p class="result_head">鋼と毒によわい</p>
    <p>おもなポケモン：ピッピ、ピクシー、プリン、プクリン、ブル、グランブル、クチート</p>`;
    $('.result').html(text1);
    break;

    case '炎':
    const text2 = `<p class="result_head">水と地面と岩によわい</p>
    <p>おもなポケモン：ヒトカゲ、リザードン、ロコン、キュウコン、ウィンディ、ボニータ、ブーバー、ブースター、ホウオウ、ドンメル、バクーダ</p>`;
    $('.result').html(text2);
    break;

    case '水':
    const text3 = `<p class="result_head">電気と草によわい</p>
    <p>おもなポケモン：ゼニガメ、カメックス、コダック、ゴルダック、ニョロモ、メノクラゲ、ヤドン、
    クラブ、タッツー、ヒトデマン、スターミー、コイキング、ギャラドス、マリル、キャモメ</p>`;
    $('.result').html(text3);
    break;
  }
});
});
</script>
</body>
</html>