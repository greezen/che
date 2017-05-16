<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="http://che.adipower.net/" />
<meta name="Generator" content="68ECSHOP v4_2" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link rel="stylesheet" type="text/css" href="themes/68ecshopcom_360buy/css/article.css" />
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/jquery-1.9.1.min.js"></script>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="article-box clearfix">
  <div id="focus">
    <div class="slider">
      <div class="slider-panel"> <?php echo $this->fetch('library/ar_ad.lbi'); ?> </div>
      <div class="slider-extra"> <a class="curr" href="javascript:;">1</a> <a href="javascript:;">2</a> <a href="javascript:;">3</a> <a href="javascript:;">4</a> <a href="javascript:;">5</a> </div>
    </div>
  </div>
  <div class="focus-today">
    <h3></h3>
    <?php $_from = $this->_var['article_top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
    <div class="focus-news">
      <h4><?php echo $this->_var['article']['title']; ?></h4>
      <p class="k_h"><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank"><?php echo sub_str($this->_var['article']['content'],60); ?></a> </p>
      <p><a href="<?php echo $this->_var['article']['url']; ?>" class="red" target="_blank">【详细阅读】</a></p>
    </div>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <ul class="allList bodertop mt10">
      <?php $_from = $this->_var['article_top1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
      <li><a class="kind" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank"><?php echo $this->_var['article']['cat_name']; ?></a><span>|</span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo $this->_var['article']['title']; ?></a></li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
    <ul class="allList bodertop mt10">
      <?php $_from = $this->_var['article_top2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
      <li><a class="kind" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank"><?php echo $this->_var['article']['cat_name']; ?></a><span>|</span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo $this->_var['article']['title']; ?></a></li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
  </div>
  <div class="page-side">
    <div class="side-con"> 
      <?php $_from = $this->_var['article_right1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
      <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
      <div class="title"><a class="more" href="<?php echo $this->_var['article']['cat_url']; ?>"></a><?php echo $this->_var['article']['cat_name']; ?></div>
      <?php endif; ?> 
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <ul class="body">
        <?php $_from = $this->_var['article_right1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] < 11): ?>
        <li>
          <span class="icon <?php if ($this->_foreach['name']['iteration'] < 4): ?>curr<?php endif; ?> "><?php echo $this->_foreach['name']['iteration']; ?></span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo sub_str($this->_var['article']['title'],16); ?></a>
        </li>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      </ul>
    </div>
    <div class="pic Right"> 
      <?php $_from = $this->_var['article_imgad1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'articleimg');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['articleimg']):
        $this->_foreach['name']['iteration']++;
?> 
      <a href="<?php echo $this->_var['articleimg']['url']; ?>" target="_blank" title="<?php echo $this->_var['articleimg']['title']; ?>"><img src="<?php echo $this->_var['articleimg']['img']['0']; ?>" width="273" height="110"></a> 
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
    </div>
  </div>
</div>
<div class="article-box home-ad">
  <div class="ad-list"><?php echo $this->fetch('library/ar_ad_mid.lbi'); ?></div>
</div>
<div class="article-box clearfix">
  <div class="main-con"> <?php echo $this->fetch('library/article_tit1.lbi'); ?>
    <div class="body">
      <div class="first"> 
        <?php $_from = $this->_var['article_left1_cat1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
        <div class="head"> <span><a href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank"><?php echo $this->_var['article']['cat_name']; ?></a></span>
          <a class="head-more" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank">更多</a>
        </div>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <ul class="allList">
          <?php $_from = $this->_var['article_left1_cat1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
          <li><a class="kind" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank" title="<?php echo $this->_var['article']['cat_name']; ?>"><?php echo $this->_var['article']['cat_name']; ?></a><span>|</span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo $this->_var['article']['title']; ?></a></li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
      </div>
      <div class="first"> 
        <?php $_from = $this->_var['article_left1_cat2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
        <div class="head"> <span><a href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank"><?php echo $this->_var['article']['cat_name']; ?></a></span>
          <a class="head-more" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank">更多</a>
        </div>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <ul class="allList">
          <?php $_from = $this->_var['article_left1_cat2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
          <li><a class="kind" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank" title="<?php echo $this->_var['article']['cat_name']; ?>"><?php echo $this->_var['article']['cat_name']; ?></a><span>|</span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo $this->_var['article']['title']; ?></a></li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="page-side">
    <div class="side-con"> 
      <?php $_from = $this->_var['article_right2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
      <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
      <div class="title"><a class="more" href="<?php echo $this->_var['article']['cat_url']; ?>"></a><?php echo $this->_var['article']['cat_name']; ?></div>
      <?php endif; ?> 
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <ul class="body">
        <?php $_from = $this->_var['article_right2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] < 11): ?>
        <li>
          <span class="icon <?php if ($this->_foreach['name']['iteration'] < 4): ?>curr<?php endif; ?>"><?php echo $this->_foreach['name']['iteration']; ?></span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo sub_str($this->_var['article']['title'],20); ?></a>
        </li>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      </ul>
    </div>
  </div>
</div>
<div class="article-box"> 
	<div class="article-img-box">
        <?php $_from = $this->_var['article_imgtit1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
        <div class="sec-title-1">
            <a class="more" href="<?php echo $this->_var['article']['cat_url']; ?>">更多&gt;&gt;</a>
            <h3><?php echo $this->_var['article']['cat_name']; ?></h3>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <ul>
            <?php $_from = $this->_var['article_img1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'articleimg');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['articleimg']):
        $this->_foreach['name']['iteration']++;
?> 
            <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
            <li class="focus">
              <p><a href="<?php echo $this->_var['articleimg']['url']; ?>"><img class="view" alt="<?php echo $this->_var['articleimg']['title']; ?>" src="<?php if ($this->_var['articleimg']['img']['0']): ?><?php echo $this->_var['articleimg']['img']['0']; ?><?php else: ?>themes/68ecshopcom_360buy/images/article_img.jpg<?php endif; ?>"></a></p>
              <p><a class="txt" title="<?php echo $this->_var['articleimg']['title']; ?>" target="_blank"
          href="<?php echo $this->_var['articleimg']['url']; ?>"><?php echo sub_str($this->_var['articleimg']['title'],10); ?></A></P>
            </li>
            <?php endif; ?> 
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
            <?php $_from = $this->_var['article_img1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'articleimg');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['articleimg']):
        $this->_foreach['name']['iteration']++;
?> 
            <?php if ($this->_foreach['name']['iteration'] > 1): ?>
            <li>
              <p><a href="<?php echo $this->_var['articleimg']['url']; ?>" target="_blank"><img class="view" alt="<?php echo $this->_var['articleimg']['title']; ?>" src="<?php if ($this->_var['articleimg']['img']['0']): ?><?php echo $this->_var['articleimg']['img']['0']; ?><?php else: ?>themes/68ecshopcom_360buy/images/article_img.jpg<?php endif; ?>"></a></p>
              <p><a class="txt" title="<?php echo $this->_var['articleimg']['title']; ?>" target="_blank"
          href="<?php echo $this->_var['articleimg']['url']; ?>"><?php echo sub_str($this->_var['articleimg']['title'],10); ?></a></p>
            </li>
            <?php endif; ?> 
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
  	</div>
</div>
<div class="article-box clearfix">
  <div class="main-con"> <?php echo $this->fetch('library/article_tit2.lbi'); ?>
    <div class="body">
      <div class="first"> 
        <?php $_from = $this->_var['article_left2_cat1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
        <div class="head"> <span><a href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank"><?php echo $this->_var['article']['cat_name']; ?></a></span>
          <a class="head-more" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank">更多</a>
        </div>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <ul class="allList">
          <?php $_from = $this->_var['article_left2_cat1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
          <li><a class="kind" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank" title="<?php echo $this->_var['article']['cat_name']; ?>"><?php echo $this->_var['article']['cat_name']; ?></a><span>|</span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo $this->_var['article']['title']; ?></a></li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
      </div>
      <div class="first"> 
        <?php $_from = $this->_var['article_left2_cat2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
        <div class="head"> <span><a href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank"><?php echo $this->_var['article']['cat_name']; ?></a></span>
          <a class="head-more" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank">更多</a>
        </div>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <ul class="allList">
          <?php $_from = $this->_var['article_left2_cat2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
          <li><a class="kind" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank" title="<?php echo $this->_var['article']['cat_name']; ?>"><?php echo $this->_var['article']['cat_name']; ?></a><span>|</span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo $this->_var['article']['title']; ?></a></li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="page-side">
    <div class="side-con"> 
      <?php $_from = $this->_var['article_right3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
      <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
      <div class="title"><a class="more" href="<?php echo $this->_var['article']['cat_url']; ?>"></a><?php echo $this->_var['article']['cat_name']; ?></div>
      <?php endif; ?> 
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <ul class="body">
        <?php $_from = $this->_var['article_right3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] < 11): ?>
        <li>
          <span class="icon <?php if ($this->_foreach['name']['iteration'] < 4): ?>curr<?php endif; ?>"><?php echo $this->_foreach['name']['iteration']; ?></span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo sub_str($this->_var['article']['title'],20); ?></a>
        </li>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      </ul>
    </div>
  </div>
</div>
<div class="article-box article-img-box1"> 
  <?php $_from = $this->_var['article_imgtit2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
  <div class="sec-title-1">
    <a class="more" target="_blank" href="<?php echo $this->_var['article']['cat_url']; ?>">更多&gt;&gt;</a>
    <h3><?php echo $this->_var['article']['cat_name']; ?></h3>
  </div>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <ul>
    <?php $_from = $this->_var['article_img2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'articleimg');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['articleimg']):
        $this->_foreach['name']['iteration']++;
?>
    <li <?php if (($this->_foreach['name']['iteration'] <= 1)): ?>class="first"<?php endif; ?>>
      <p><a href="<?php echo $this->_var['articleimg']['url']; ?>" target="_blank"><img class="view" 
  alt="<?php echo $this->_var['articleimg']['title']; ?>" src="<?php if ($this->_var['articleimg']['img']['0']): ?><?php echo $this->_var['articleimg']['img']['0']; ?><?php else: ?>themes/68ecshopcom_360buy/images/article_img.jpg<?php endif; ?>"></a></p>
      <p><a class="txt" title="<?php echo $this->_var['articleimg']['title']; ?>" target="_blank" href="<?php echo $this->_var['articleimg']['url']; ?>"><?php echo sub_str($this->_var['articleimg']['title'],10); ?></a></p>
    </li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>
<div class="article-box clearfix">
  <div class="main-con"> <?php echo $this->fetch('library/article_tit3.lbi'); ?>
    <div class="body">
      <div class="first"> 
        <?php $_from = $this->_var['article_left3_cat1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
        <div class="head"> <span><a href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank"><?php echo $this->_var['article']['cat_name']; ?></a></span>
          <a class="head-more" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank">更多</a>
        </div>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <ul class="allList">
          <?php $_from = $this->_var['article_left3_cat1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
          <li><a class="kind" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank" title="<?php echo $this->_var['article']['cat_name']; ?>"><?php echo $this->_var['article']['cat_name']; ?></a><span>|</span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo $this->_var['article']['title']; ?></a></li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
      </div>
      <div class="first"> 
        <?php $_from = $this->_var['article_left3_cat2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
        <div class="head"> <span><a href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank"><?php echo $this->_var['article']['cat_name']; ?></a></span>
          <a class="head-more" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank">更多</a> 
        </div>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <ul class="allList">
          <?php $_from = $this->_var['article_left3_cat2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
          <li><a class="kind" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank" title="<?php echo $this->_var['article']['cat_name']; ?>"><?php echo $this->_var['article']['cat_name']; ?></a><span>|</span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo $this->_var['article']['title']; ?></a></li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="page-side">
    <div class="side-con"> 
      <?php $_from = $this->_var['article_right4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
      <?php if ($this->_foreach['name']['iteration'] <= 1): ?>
      <div class="title"><a class="more" href="<?php echo $this->_var['article']['cat_url']; ?>"></a><?php echo $this->_var['article']['cat_name']; ?></div>
      <?php endif; ?> 
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <ul class="body">
        <?php $_from = $this->_var['article_right4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['name']['iteration']++;
?> 
        <?php if ($this->_foreach['name']['iteration'] < 11): ?>
        <li>
        	<span class="icon <?php if ($this->_foreach['name']['iteration'] < 4): ?>curr<?php endif; ?>"><?php echo $this->_foreach['name']['iteration']; ?></span><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank" title="<?php echo $this->_var['article']['title']; ?>"><?php echo sub_str($this->_var['article']['title'],16); ?></a>
        </li>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      </ul>
    </div>
  </div>
</div>
<div class="article-img-box1 article-box"> 
  <?php $_from = $this->_var['article_imgtit3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
  <div class="sec-title-1">
    <a class="more" href="<?php echo $this->_var['article']['cat_url']; ?>" target="_blank">更多&gt;&gt;</a>
    <h3><?php echo $this->_var['article']['cat_name']; ?></h3>
  </div>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <ul>
    <?php $_from = $this->_var['article_img3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'articleimg');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['articleimg']):
        $this->_foreach['name']['iteration']++;
?>
    <li <?php if (($this->_foreach['name']['iteration'] <= 1)): ?>class="first"<?php endif; ?>>
      <p><a href="<?php echo $this->_var['articleimg']['url']; ?>" target="_blank"><img class="view" alt="<?php echo $this->_var['articleimg']['title']; ?>" src="<?php if ($this->_var['articleimg']['img']['0']): ?><?php echo $this->_var['articleimg']['img']['0']; ?><?php else: ?>themes/68ecshopcom_360buy/images/article_img.jpg<?php endif; ?>"></a></p>
      <p><a class="txt" title="<?php echo $this->_var['articleimg']['title']; ?>" target="_blank" href="<?php echo $this->_var['articleimg']['url']; ?>"><?php echo sub_str($this->_var['articleimg']['title'],10); ?></a></p>
    </li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>
<div class="site-footer">
  <div class="footer-related"> 
    <?php echo $this->fetch('library/help.lbi'); ?> 
    <?php echo $this->fetch('library/page_footer.lbi'); ?> 
  </div>
</div>
</body>
</html>
