<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>BW Website</title>
		
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		
		<link href="/css/bootstrap.min.css" rel="stylesheet" />
		<link href="/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link href="/css/custom.css" rel="stylesheet" />
		
		<link href="/css/jquery.tagsinput.css" rel="stylesheet" />

		<!-- HTML5 shim for IE backwards compatibility -->
			<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
	</head>
<body>

		<div class="deviceDetector" style="width: 0; height: 0; display: block; overflow: hidden;" >
			<p class="visible-phone vPhone" >Phone</p>
			<p class="visible-tablet vTablet" >Tablet</p>
			<p class="visible-desktop vDesktop" >Desktop</p>
		</div>
	

		<div class="modelBoxHolder" >
			<div class="modal hide fade" id="groupModal" >
			  <div class="modal-header"  >
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Add a new Group</h3>
			  </div>
			  <div class="modal-body">
				<p>Some Group Lists will appear here</p>
			  </div>
			  <div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal" >Cancel</a>
				<a href="#" class="btn btn-primary btn-success" data-dismiss="modal" >Add Group</a>
			  </div>
			</div>


			<div class="modal hide fade" id="newsrssModal" >
			  <div class="modal-header"  >
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Add a news</h3>
			  </div>
			  <div class="modal-body">
				<p>you can add or delete news from here</p>
			  </div>
			  <div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal" >Cancel</a>
				<a href="#" class="btn btn-primary btn-success" data-dismiss="modal" >Add</a>
			  </div>
			</div>	


			<div class="modal hide fade" id="updatesModal" >
			  <div class="modal-header"  >
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Add an Update</h3>
			  </div>
			  <div class="modal-body">
				<p>you can add or delete updates from here</p>
			  </div>
			  <div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal" >Cancel</a>
				<a href="#" class="btn btn-primary btn-success" data-dismiss="modal" >Add</a>
			  </div>
			</div>	
		</div>												



		<div class="container header" >
			<div class="row" >
				<div class="span2" >
					<h1><a href="/" ><img src="<?=Yii::app()->params['FrontEndLogo']?>" alt="" /></a></h1>
				</div>
				<div class="span10" >
						<div class="row" >

							<div class="span5 searchBox" >
								<div class="row" >
									<div class="span5">
                                    <form class="navbar-search pull-left" action="">
										<table class="table table-condensed">
											<tr>
												<td width="90%" >
												  <input class="input-block-level" placeholder="Search for People, Groups, Files..." type="text">
												</td>
												<td width="10%" >
													<button class="btn pull-left" type="button"><i class="icon-search icon-white"></i></button>
												</td>
											</tr>
										</table>
                                      </form>
									</div>
								</div> 
							</div> <!-- /searchBox -->

							<div class="span5 mainNav" >
								<div class="navbar" >
									<div class="navbar_inner" >

										<a href="#" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" >
											<span class="icon-bar" ></span>
											<span class="icon-bar" ></span>
											<span class="icon-bar" ></span>									
										</a>

										<div class="nav-collapse" >
                                        <? 
											$this->widget('bootstrap.widgets.TbMenu', array(
											'type'=>'null',
											'htmlOptions' => array('class' => 'nav pull-right'),
											'items' => array(
												array('label' => 'Home', 'url' => '/wall/','active'=>(Yii::app()->controller->Id=="wall")? "true" : ""),
												array('label' => 'Sales', 'url' => '#','active'=>(Yii::app()->controller->Id=="sales")? "true" : ""),
												array('label' => 'Projects', 'url' => '#','active'=>(Yii::app()->controller->Id=="projects")? "true" : ""),
												array('label' => 'Service', 'url' => '#','active'=>(Yii::app()->controller->Id=="service")? "true" : ""),
												array('label' => '','linkOptions' => array('class'=>"iconNotify"),'url' => '#'),
												array('label' =>Yii::app()->user->Name, 'url' => '#', 'items' => array(
												array('label' => Yii::t('translate','Profile'), 'url' => '/user/update'),
												array('label' => 'Messages', 'url' => '/messages/'),
												array('label' => 'AppSettings','visible'=>(Yii::app()->user->UserType == 'Admin')? true : false, 'url' => '/appsettings/settings/index/type/social'),
												array('label' => 'Tags','visible'=>(Yii::app()->user->UserType == 'Admin')? true : false, 'url' => '/tags/admin/'),
												array('label' => 'Get Out', 'url' => '/site/logout')
												)),
												
											),
										));
										?>                                        
											
										</div>

									</div>
								</div>	
							</div> <!-- /mainNav -->							
						</div>
				</div>
			</div>
		</div>


<div class="container newsSlider">
  <div class="row-fluid">
	<div class="span12 border_grey_low">
	  <p class="icon-bullhorn pull-left"></p>

					<div id="newsSliderHolder" class="carousel slide pull-left">
						  <!-- Carousel items -->
						  <div class="carousel-inner text_grey">
							    <div class="active item">Project RZ nearing completion, final checking & testing to commence by this weekend. Going online as per scheduled on 10 July.</div>
							    <div class="item">Again another texts follows</div>
							    <div class="item">Final bunch of text follows and a start over again</div>
						  </div>
					</div>

	  <div class="nsControls pull-right">
						<!-- Carousel nav -->
						<a class="carousel-control left" href="#newsSliderHolder" data-slide="prev"><i class="icon-chevron-left icon-green" ></i></a>
						<a class="carousel-control right" href="#newsSliderHolder" data-slide="next"><i class="icon-chevron-right icon-green" ></i></a>
	  </div>						
				</div>
			</div>
		</div> <!-- /newsSlider -->
        

		<div class="container mainBody">
			<div class="row">
		 <!-- /newsSlider -->
				<?php //echo $this->renderPartial("common.views.common._leftcolumn"); ?>
                	<div class="span2 sideNav" >
     <?php
	 	
          $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
				'htmlOptions' => array('class' => 'nav nav-list'),
                'items' => array(
					 array('label'=>'Create', 'url'=>'/wall/', 'icon'=>'icon-plane icon-blue', 'linkOptions'=>array("class"=>"nav-header background_blue sideNavBtn dropdown"),
							'items'=>array(
								
								array('label'=>'Menu 01', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="tasks")? "true" : ""),
								array('label'=>'Menu 02', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="admin")? "true" : ""),
								array('label'=>'Menu 03', 'url'=>'#', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="create")? "true" : ""),
								
						 )
					 ),
                     array('label'=>'Activities', 'url'=>'/wall/', 'icon'=>'icon-plane icon-blue', 'active'=>(Yii::app()->controller->Id=="wall")? "true" : ""),
                     array('label'=>'Tasks', 'icon'=>'icon-calendar icon-grey', 'active'=>(Yii::app()->controller->Id=="tasks")? "true" : "",'items'=>array(
                     		
                     		array('label'=>'All Tasks', 'icon'=>'icon-calendar icon-grey', 'url'=>'/tasks/', 'active'=>(Yii::app()->controller->Id=="tasks")? "true" : ""),
                     		array('label'=>'My Tasks', 'icon'=>'icon-calendar icon-grey', 'url'=>'/tasks/admin', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="admin")? "true" : ""),
                     		array('label'=>'Create', 'icon'=>'icon-file-alt icon-grey', 'url'=>'/tasks/create', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="create")? "true" : ""),
                     		
                     )
                     		
                ),
                     array('label'=>'Contacts', 'icon'=>'icon-user icon-grey', 'url'=>'/contacts/', 'active'=>(Yii::app()->controller->Id=="contacts")? "true" : ""),
                     array('label'=>'Files', 'icon'=>'icon-file icon-grey', 'url'=>'/fileManager/', 'active'=>(Yii::app()->controller->Id=="fileManager")? "true" : ""),
                	array('label'=>'Timesheets', 'icon'=>'icon-time icon-grey', 'url'=>'#/timesheet/', 'active'=>(Yii::app()->controller->Id=="timesheet")? "true" : ""),

                )
           )); 
      ?>					
				</div> <!-- /sideNav -->
                 <!-- /sideNav -->

				<div class="span10 bodyContent">						
					<div class="row">
                    	<div class="span10">
							<div class="row-fluid">				
							 	<div class="span9 mainFeeds">
								 	<div class="mfBox">
<div class="row-fluid mfLinks">
  <div class="span12">
	<ul class="inline">
	  <li class="active">Conversation</li>
								 					<li>Message</li>
								 					<li>Announcement</li>
								 					<li>Praise</li>
	</ul>
								 			</div>
								 		</div> <!-- /mfLinks -->
								 		<div class="row-fluid mfboxTop">
									 		<div class="span12">
<div class="txtboxHolder">
									 				<p class="postBoxEfxBtn01 text_grey" >Type here</p>
  <textarea cols="1" rows="3" ></textarea>
</div>
                                                <div class="row-fluid mfboxControls">
											 		<div class="span12">
											 			<div class="mfControls_Holder">
											 				<ul class="inline">
											 					<li><a href="" ><img src="/images/uploadicon.png" alt="" /></a></li>
											 					<li><a href="" ><img src="/images/linkicon.png" alt="" /></a></li>
											 					<li><a href="" ><img src="/images/movieicon.png" alt="" /></a></li>
										 				</u>
											 			</div>
											 		</div>
											 	</div> 	
									 		</div>
									 	</div> <!-- /mfboxTop -->
                                        

									 	<div class="row-fluid postBtnbox" >
									 		<div class="span12" >
									 			<p class="pull-left" ><i class="icon-arrow-right icon-blue" ></i>To:</p>
									 			<!-- 
									 			<ul class="inline pull-left" >
									 				<li><p class="tagBox" >helo<i class="icon-remove-circle" ></i></p></li>
									 				<li><p class="tagBox" >helo<i class="icon-remove-circle" ></i></p></li>

									 				<li><input type="text" /></li>
									 			</ul>
									 			-->
									 			<div class="tagInput pull-left" >
									 				<input type='text' class="tags tagInputBox" placeholder="+Add Tags" />
									 			</div> <!-- /tagInput -->
							 			

									 			<button class="btn pull-left" >Post</button>
									 			<p class="pull-left postBoxEfxBtn02" >Cancel</p>
									 		</div>
									 		<p class="clearfix" ></p>
									 		<div class="row-fluid" >
									 			<div class="span12" >
										 			<div class="tagSuggestionHolder" >
										 				<div class="tagSuggestions" >
										 					<p class="tagError" >No TAGS found!</p>
										 					<div class="tagLists" >
										 						
																<div class="row-fluid taglist_head" >
																	<div class="span3 active" >All</div>
																	<div class="span3" >People</div>
																	<div class="span3" >Groups</div>
																	<div class="span3" >Departments</div>
																</div>
																
																<div class="taglist_itemHolder" >
																	<ul class="inline" >
																		<li>Tag</li>
																		<li>Tag</li>
																		<li>Tag</li>
																		<li>Tag</li>
																		<li>Tag</li>
																		<li>Tag</li>
																	</ul>
																</div>
															

										 					</div>
										 				</div>	
										 			</div>	
									 			</div>
									 		</div>
</div> <!-- /postBtnbox -->

<div class="row-fluid feedlistItems" >
									 		<div class="pull-right dropdown" >
									 			<a href="#" class="dropdown-toggle" data-toggle="dropdown" >Sort<i class="icon-chevron-down icon-grey" ></i></a>
									 			<ul class="dropdown-menu" >
									 				<li><a href="#" >Recent</a></li>
									 				<li><a href="#" >Oldest</a></li>
									 			</ul>
									 		</div>

									 		<div class="row-fluid clearfix feedItem" >
									 			<div class="span12" >
									 				<div class="row-fluid" >
									 					<div class="span12" >

									 						<table >
									 							<tr>
									 								<td>
									 									<img src="/images/photo.jpg" class="img-polaroid userimgbig pull-left" alt="" />
									 								</td>
									 								<td>


											 				<div class="feedItem_Content" >

											 					<div class="row-fluid feedItem_Content_MainUser" >
											 						<div class="span12" >
											 							<ul class="unstyled" >
											 								<li><span class="text_blue" >Tim Sutherland <i class="icon-arrow-right icon-blue" ></i></span> Anne, Tim, Malinda</li>
											 								<li><small class="text_grey" >30/4/2013</small></li>
											 							</ul>
											 							<h5>The redesigning of the BW Intranet Portal</h5>
											 							<p>Hello Team BW, we have confirmation on the redesigning of the BW Portal. They want the whole Web &amp; Intranet Portal design to follow their new Logo and colors. The important part will be converting it to Responsive Web. The framework and CMS will need an upgrade. I think this will be a total redesign, ony the text data &amp; photos will remain from the old/existing web. Let’s team up and discuss this tomorrow morning.</p>

											 							<div class="cmntlikeBox" >
											 								<ul class="inline pull-left" >
											 									<li><a href="" ><i class="icon-comment" ></i>Comments</a></li>
											 									<li><a href="" ><i class="icon-thumbs-up" ></i>Like</a></li>
											 								</ul>

											 								<p class="pull-right text_grey" ><i class="icon-time icon-grey" ></i>Today at 03.00 A.M</p>

											 								<div class="addCmntBox" >
											 									<input type="text" placeholder="Type your comment here" />
											 								</div>
											 							</div>
											 						</div>
											 					</div> <!-- /feedItem_Content_MainUser -->

											 					<div class="row-fluid feedItem_Comments" >
											 						<div class="span12" >
											 							<div class="cmntbox_top" >
											 								<img src="/images/cmntarrow.png" alt="" />
											 							</div>

											 							<div class="cmntbox_body border_grey_low" >

											 									<div class= "cmntusers" >
											 										<table>
											 											<tr>
											 												<td rowspan="2" ><img src="/images/cmntuser.jpg" class="img-polaroid pull-left" alt="" /></td>
											 												<td>														 								<ul class="inline pull-left" >
														 									<li class="text_blue" >Anne Edmunds</li>
														 									<li class="text_grey" ><i class="icon-time icon-grey" ></i><small>Today at 03.30 A.M</small></li>
														 									<li class="text_grey" ><i class="icon-star icon-grey" ></i><small>10 Likes</small></li>
														 								</ul>
														 							</td>
											 											</tr>
											 											<tr>
											 												<td><p class="pull-left cmnttxt" >Sure, tomorrow @ 9:30 AM is it?</p></td>
											 											</tr>
											 										</table>
	
											 									</div> <!-- /cmntusers -->


											 									<div class= "cmntusers" >
											 										<table>
											 											<tr>
											 												<td rowspan="2" ><img src="/images/cmntuser.jpg" class="img-polaroid pull-left" alt="" /></td>
											 												<td>														 								<ul class="inline pull-left" >
														 									<li class="text_blue" >Anne Edmunds</li>
														 									<li class="text_grey" ><i class="icon-time icon-grey" ></i><small>Today at 03.30 A.M</small></li>
														 									<li class="text_grey" ><i class="icon-star icon-grey" ></i><small>10 Likes</small></li>
														 								</ul>
														 							</td>
											 											</tr>
											 											<tr>
											 												<td><p class="pull-left cmnttxt" >Sure, tomorrow @ 9:30 AM is it?</p></td>
											 											</tr>
											 										</table>
	
											 									</div> <!-- /cmntusers -->


											 									<div class= "cmntusers" >
											 										<table>
											 											<tr>
											 												<td rowspan="2" ><img src="/images/cmntuser.jpg" class="img-polaroid pull-left" alt="" /></td>
											 												<td>														 								<ul class="inline pull-left" >
														 									<li class="text_blue" >Anne Edmunds</li>
														 									<li class="text_grey" ><i class="icon-time icon-grey" ></i><small>Today at 03.30 A.M</small></li>
														 									<li class="text_grey" ><i class="icon-star icon-grey" ></i><small>10 Likes</small></li>
														 								</ul>
														 							</td>
											 											</tr>
											 											<tr>
											 												<td><p class="pull-left cmnttxt" >Sure, tomorrow @ 9:30 AM is it?</p></td>
											 											</tr>
											 										</table>
	
											 									</div> <!-- /cmntusers -->


											 									<div class= "cmntusers" >
											 										<table>
											 											<tr>
											 												<td rowspan="2" ><img src="/images/cmntuser.jpg" class="img-polaroid pull-left" alt="" /></td>
											 												<td>														 								<ul class="inline pull-left" >
														 									<li class="text_blue" >Anne Edmunds</li>
														 									<li class="text_grey" ><i class="icon-time icon-grey" ></i><small>Today at 03.30 A.M</small></li>
														 									<li class="text_grey" ><i class="icon-star icon-grey" ></i><small>10 Likes</small></li>
														 								</ul>
														 							</td>
											 											</tr>
											 											<tr>
											 												<td><p class="pull-left cmnttxt" >Sure, tomorrow @ 9:30 AM is it?</p></td>
											 											</tr>
											 										</table>
	
											 									</div> <!-- /cmntusers -->									 									

											 									<div class="clearfix addCmntLink" >
											 										<p><a href="" ><i class="icon-plus-sign icon-green" ></i><small>Add Comment</small></a></p>
											 									</div>



											 							</div>
											 						</div>
											 					</div> <!-- /feedItem_Comments -->

											 				</div>

									 								</td>
									 							</tr>
									 						</table>

									 															 						



									 					</div>
									 				</div>


									 			</div>
									 		</div> <!-- /feedItem -->				





									 		<div class="row-fluid clearfix feedItem" >
									 			<div class="span12" >
									 				<div class="row-fluid" >
									 					<div class="span12" >

									 						<table >
									 							<tr>
									 								<td>
									 									<img src="/images/photo.jpg" class="img-polaroid userimgbig pull-left" alt="" />
									 								</td>
									 								<td>


											 				<div class="feedItem_Content" >

											 					<div class="row-fluid feedItem_Content_MainUser" >
											 						<div class="span12" >
											 							<ul class="unstyled" >
											 								<li><span class="text_blue" >Rushenn Mohad </li>
											 								<li><small class="text_grey" >30/4/2013</small></li>
											 							</ul>

											 							<p class="metaData text_grey" ><i class="icon-picture" ></i>Added 25 Photo(s) to, <a href="" >World Tour</a> Album</p>

											 							<ul class="inline imgList" >
											 								<li><img src="/images/smallthumb.jpg" alt="" /></li>
											 								<li><img src="/images/smallthumb.jpg" alt="" /></li>
											 								<li><img src="/images/smallthumb.jpg" alt="" /></li>
											 								<li><img src="/images/smallthumb.jpg" alt="" /></li>
											 							</ul>

											 							<div class="cmntlikeBox clearfix" >
											 								<ul class="inline pull-left" >
											 									<li><a href="" ><i class="icon-comment" ></i>Comments</a></li>
											 									<li><a href="" ><i class="icon-thumbs-up" ></i>Like</a></li>
											 								</ul>

											 								<p class="pull-right text_grey" ><i class="icon-time icon-grey" ></i>Today at 03.00 A.M</p>
											 							</div>
											 						</div>
											 					</div> <!-- /feedItem_Content_MainUser -->



											 				</div>

									 								</td>
									 							</tr>
									 						</table>

									 															 						



									 					</div>
									 				</div>


									 			</div>
									 		</div> <!-- /feedItem -->	


		
									 	</div>





								 </div> <!-- /mainFeeds -->
								</div>






								 <div class="span3 rssNews" >
								 	<div class="rnBox" >
										<div class="rnbox_Title" >
											<p class="pull-left" >News</p>
											<ul class="inline pull-right" >
												<li><a href="#newsrssModal" data-toggle="modal" ><i class="icon-plus icon-green" ></i></a></li>
											</ul>
										</div>

										<p class="text_blue" >
											<small class="text_grey" >Awwwards News - 2 minutes ago</small>
											<a href="#" class="text_blue" >Buzinessware wins the SOTM...</a>
										</p>

										<p class="text_blue" >
											<small class="text_grey" >Awwwards News - 2 minutes ago</small>
											<a href="#" class="text_blue" >Buzinessware wins the SOTM...</a>
										</p>

										<p class="text_blue" >
											<small class="text_grey" >Awwwards News - 2 minutes ago</small>
											<a href="#" class="text_blue" >Buzinessware wins the SOTM...</a>
										</p>

										<p class="text_blue" >
											<small class="text_grey" >Awwwards News - 2 minutes ago</small>
											<a href="#" class="text_blue" >Buzinessware wins the SOTM...</a>
										</p>

								 	</div> <!-- /rnBox -->


								 	<div class="rnBox" >
										<div class="rnbox_Title" >
											<p class="pull-left" >Upcoming Tasks</p>
											<ul class="inline pull-right" >
												<li><a href="#newsrssModal" data-toggle="modal" ><i class="icon-cog icon-grey" ></i></a></li>
												<li><a href="#newsrssModal" data-toggle="modal" ><i class="icon-plus icon-green" ></i></a></li>
											</ul>
										</div>

										<p class="text_blue" >
											<small class="text_grey" >Awwwards News - 2 minutes ago</small>
											<a href="#" class="text_blue" >Buzinessware wins the SOTM...</a>
										</p>

										<p class="text_blue" >
											<small class="text_grey" >Awwwards News - 2 minutes ago</small>
											<a href="#" class="text_blue" >Buzinessware wins the SOTM...</a>
										</p>

										<p class="text_blue" >
											<small class="text_grey" >Awwwards News - 2 minutes ago</small>
											<a href="#" class="text_blue" >Buzinessware wins the SOTM...</a>
										</p>

										<p class="text_blue" >
											<small class="text_grey" >Awwwards News - 2 minutes ago</small>
											<a href="#" class="text_blue" >Buzinessware wins the SOTM...</a>
										</p>

								 	</div> <!-- /rnBox -->								 	


								 </div>	<!-- /rssNews -->	

							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>	

		<div class="container-fluid footer" >
			<div class="row-fluid" >
				<div class="span12" >
					<p>&copy; 2001-2013 buzinessware inc.</p>
				</div>
			</div>
		</div>			


	
<script src="/js/jquery_offline.min.js"></script>
<script src="/js/bootstrap.min.js" ></script>
<script src="/js/custom.js" ></script>
<script src="/js/jquery.tagsinput.jss" ></script>
	</body>
</html>