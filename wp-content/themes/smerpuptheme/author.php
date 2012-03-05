<?php get_header(); ?>
<div id="primary">
<div id="content" role="main">

<!-- This sets the $curauth variable -->

    <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>
<h1 class="entry-title">About This Blog</h1>
<p>
Hi and welcome to <a href="http://blog.smerpup.com/">my blog</a>! I'm Dezhi Liu. This blog majorly is about sharing the things that I've found out occasionally. Stay around and hope you enjoy!
</p>
    <h1 class="entry-title">About 
<span class="author vcard"><a class="url fn n" href="http://www.google.com/profiles/107282351429131338561/" title="Dezhi Liu" rel="me" rel="author"><?php echo $curauth->nickname; ?></h1></a></span>
    <dl>
        <dt>Website</dt>
        <dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>
        <dt>Email</dt>
        <dd><a href="mailto:<?php echo $curauth->user_email; ?>"><?php echo $curauth->user_email; ?> <img src="http://smerpup.com/img/email.png" height="15px"/> </a></dd>
    </dl>

</div></div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>