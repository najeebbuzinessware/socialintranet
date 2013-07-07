


<!-- Psoting -->
<div class="postArea">
     <ul class="postMenu">
          <li class="active"><a href="">All</a></li>
          <li>
               <a href="">
                    <i class="icon-briefcase"></i>
                    Company
               </a>
          </li>
          <li>
               <a href="">
                    <i class="icon-user"></i>
                    Me
               </a>
          </li>
          <li class="dropdown">
               <a href="" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-group"></i>
                    Group
               </a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				<li>
					<a href="">Group 1</a>
				</li>
				<li>
					<a href="">Group 1</a>
				</li>
				<li>
					<a href="">Group 1</a>
				</li>
				<li>
					<a href="">Group 1</a>
				</li>
			</ul>
          </li>
     </ul>

	
     <textarea class="span12 postText"></textarea>
     
     <div class="postOptions">
          <ul class="postMenu">
               <li>
				<a data-placement="bottom" data-toggle="tooltip" data-original-title="Picture" class="m-t-5 ttips" href="">
					<i class="icon-picture"></i>
				</a>
			</li>
               <li><a data-placement="bottom" data-toggle="tooltip" data-original-title="Video" class="m-t-5 ttips" href=""><i class="icon-film"></i></a></li>
               <li><a data-placement="bottom" data-toggle="tooltip" data-original-title="Event" class="m-t-5 ttips" href=""><i class="icon-calendar"></i></a></li>
               <li><a data-placement="bottom" data-toggle="tooltip" data-original-title="File" class="m-t-5 ttips" href=""><i class="icon-file-alt"></i></a></li>
          </ul>
     </div>
     
     <div class="shareTo span12 m-t-20 m-l-0">
          <span class="s-To">To:</span>
          <?php
               $this->widget('bootstrap.widgets.TbSelect2', array(
                    'asDropDownList' => false,
                    'name' => 'clevertech',
                    'options' => array(
                         'tags' => array('clever','is', 'better', 'clevertech'),
                         'placeholder' => 'Share to...',
                         'width' => '40%',
                         'tokenSeparators' => array(',', ' ')
               )));	
          ?>
          <span class="s-Post"><button class="btn shareButton">Post</button></span>
     </div>
</div>

<!-- Wall Posts -->
<article class="wallPost">
     <div class="firstPost">
			 <div class="firstPost-title">
				    <img src="http://placehold.it/65x65" alt="" class="posterImg">
				    <a class="f-bold block" href="">Rushenn Body</a>
				    <span class="postDate">19/06/2013</span>
			 </div>
			 <div class="postTitle">The opening of the company intranet portal</div>
			 <p>Nullo solum meis pontus regna montes levius. Vis meis pace. Calidis inter ora hunc undas. Levitate aberant congestaque nondum sponte phoebe vesper. Tellus aeris fuerant occiduo pondus nullus coercuit pinus oppida. Reparabat aurea onus lumina volucres figuras. Ante fluminaque obstabatque circumfluus consistere nubibus.</p>
			 <div class="commentHeader">
				    <div class="comment pull-left">
						  <i class="icon-comment m-r-5"></i>Comment(10)
				    </div>
				    <div class="like pull-left m-l-20">
						  <i class="icon-thumbs-up m-r-5"></i>Like(3)
				    </div>
				    <div class="timing pull-right m-l-30">
						  <i class="icon-time m-r-5"></i>Today at 03.00 A.M
				    </div>
				    <div class="clearfix"></div>
			 </div>
			 
			 <!-- Commenting -->
			 <ul class="commentList">
				<li>
					<header class="m-b-5">
						<img src="http://placehold.it/40x40" class="posterImg" alt="">
						<a href="" class="f-bold m-r-20">Malinda Hollaway</a>
						<span class="timing m-r-20"><i class="icon-time m-r-5"></i>19/06/2013</span>
						<span class="like"><i class="icon-thumbs-up m-r-5"></i>15 Likes</span>
					</header>
					<p>Congestaque nondum sponte phoebe vesper. Tellus aeris fuerant occiduo pondus nullus coercuit pinus oppida. Reparabat aurea onus lumina volucres figuras. Ante fluminaque obstabatque circumfluus consistere nubibus.</p>
				</li>
				<li>
					<header class="m-b-5">
						<img src="http://placehold.it/40x40" class="posterImg" alt="">
						<a href="" class="f-bold m-r-20">Malinda Hollaway</a>
						<span class="timing m-r-20"><i class="icon-time m-r-5"></i>19/06/2013</span>
						<span class="like"><i class="icon-thumbs-up m-r-5"></i>15 Likes</span>
					</header>
					<p>Mod Reparabat aurea onus lumina volucres figuras. Ante fluminaque obstabatque circumfluus consistere nubibus.</p>
				</li>
				<li class="p-5">
					<div class="t-center">
						<a class="f-bold commentLink" href="javascript:void(0)"><i class="icon-plus-sign"></i> Add Comment</a>
					</div>
					
					<div class="hBlock hide">
						<textarea class="span12 postText m-b-5" placeholder="..."></textarea>
						<button class="btn">Add</button>
						<button class="btn-link cancelComment">Cancel</button>
					</div>
				</li>
			 </ul>
			 
			 
	</div>
	<div class="clearfix"></div>
</article>