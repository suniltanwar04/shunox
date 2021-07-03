<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
   
    <div class="carousel-inner hcstmbnnr" role="listbox">
    <?php 
    $counter = 0;
    $slides='';
	$Indicators='';
	$Indicators .='<div  data-slide-to="'.$counter.'"';
	// $slides .= '<div class="item active frstslide" >
	// 	<img src="uploads/banner/first-banner.jpg" />
	// 	<a href="https://shunox.in/scanning-locator" id="locateicon" class="frstbnricon"><img src="uploads/locationicon.png" /></a>
	// 	<a href="https://shunox.in/login" id="producticon"  class="frstbnricon"><img src="uploads/carticon.png" /></a>
	//   </div>';
	// $counter = 1;
    foreach($allbanners as $allbanner){
     if($counter == 0)
        {
            $Indicators .='<div  data-slide-to="'.$counter.'"';
            $slides .= '<div class="item active">
            <img src="uploads/banner/'.$allbanner->image.'" />
           
          </div>';
 
        }
        else
        {
            $Indicators .='<div  data-slide-to="'.$counter.'"';
            $slides .= '<div class="item">
            <img src="uploads/banner/'.$allbanner->image.'" />
           
          </div>';
        }
        $counter++;
    ?>
        
<?php }?>
<?php  echo $Indicators ;?>
        <?php  echo $slides;?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

