<div class="col-lg-3 col-lg-offset-1 post spacer-40">
	<h5 class="section-heading padding-top-20">CATEGORIES</h5>
	<ul class="list-group">
		<?php foreach($blog->getTags() as $key => $value) { 
			if(!empty($value))
			{
			?>
				<li class="list-group-item"><span class="badge"><?php echo $value; ?></span><a href="<?php echo $header->blogURL."index.php?tag=".$key?>"><?php echo $key; ?></a></li>
		<?php }
		}
		?>	
	</ul>
</div>
