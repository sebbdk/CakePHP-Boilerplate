<div class="galleries index">

	<div class="row">
		<nav class="navbar navbar-default" role="navigation"  style="margin: 7px;">
			<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Filter</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
				<div class="navbar-form navbar-left" role="search">

						<?php echo $this->Html->link('Fav 1', ['favorites' => 1], ['class' => 'btn btn-default']) ?>
						<?php echo $this->Html->link('Fav 2', ['favorites' => 2], ['class' => 'btn btn-default']) ?>
						<?php echo $this->Html->link('Fav 3', ['favorites' => 3], ['class' => 'btn btn-default']) ?>
						<?php echo $this->Html->link('Fav 4', ['favorites' => 4], ['class' => 'btn btn-default']) ?>
						<?php echo $this->Html->link('Fav 5', ['favorites' => 5], ['class' => 'btn btn-default']) ?>
						
				<!--		<button type="submit" class="btn btn-default">Show gifs</button>
						<button type="submit" class="btn btn-default">Show static</button>
					</div>


					<div class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Keywords">
						</div>
						<button type="submit" class="btn btn-default">Apply</button>
					</div>
				-->
				</div>
			</div>
		</nav>
	</div>

	<div class="row">
				<div>
			<table cellpadding="0" cellspacing="0" class="table gallery table-striped GalleryTable">
				<thead>
					<tr>
						<th class="GalleryAssetPreviewField"><?php echo $this->Paginator->sort('asset_preview'); ?></th>
						<th class="GalleryNameField"><?php echo $this->Paginator->sort('name'); ?></th>
						<th class="GalleryOriginField"><?php echo $this->Paginator->sort('origin'); ?></th>
						<th class="GalleryScoreField"><?php echo $this->Paginator->sort('score'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($galleries as $gallery): ?>
					<tr>
							<?php
								$arr = explode('.', $gallery['Gallery']['asset_preview']);
								$ext = array_pop($arr);
								$prepend = strrpos($gallery['Gallery']['asset_preview'], '//') === false ? '/files/uploads/':''; 
								$imgPath = $prepend . $gallery['Gallery']['asset_preview'];
							?>

							<td class='GalleryAssetPreviewField asset' style="background-image: url(<?php echo $imgPath; ?>);">
								<div class="actions">
									<span class="label label-default">Default</span>
									<span class="label label-default">Add tag..</span>

									<span style="float: right;">
										<span class="toggle-g-fav glyphicon glyphicon-star <?php echo $gallery['Gallery']['is_favorite'] >= 1 ? 'active':''; ?>" data-id="<?php echo $gallery['Gallery']['id']; ?>" data-value="1"  aria-hidden="true"></span>
										<span class="toggle-g-fav glyphicon glyphicon-star <?php echo $gallery['Gallery']['is_favorite'] >= 2 ? 'active':''; ?>" data-id="<?php echo $gallery['Gallery']['id']; ?>" data-value="2"  aria-hidden="true"></span>
										<span class="toggle-g-fav glyphicon glyphicon-star <?php echo $gallery['Gallery']['is_favorite'] >= 3 ? 'active':''; ?>" data-id="<?php echo $gallery['Gallery']['id']; ?>" data-value="3"  aria-hidden="true"></span>
										<span class="toggle-g-fav glyphicon glyphicon-star <?php echo $gallery['Gallery']['is_favorite'] >= 4 ? 'active':''; ?>" data-id="<?php echo $gallery['Gallery']['id']; ?>" data-value="4"  aria-hidden="true"></span>
										<span class="toggle-g-fav glyphicon glyphicon-star <?php echo $gallery['Gallery']['is_favorite'] >= 5 ? 'active':''; ?>" data-id="<?php echo $gallery['Gallery']['id']; ?>" data-value="5"  aria-hidden="true"></span>
									</span>	
								</div>
								<?php 
									echo $this->Html->link( $this->Html->image($imgPath),  ['action' => 'view', $gallery['Gallery']['id']], ['target' => '_blank', 'escape' => false, 'data-fancybox-group' => 'le-group', 'class' => 'fancy'] , []); 
								?>
								&nbsp;
							</td>
						<td class='GalleryNameField'><div class='limiter'><?php echo h($gallery['Gallery']['name']); ?>&nbsp;<div></td>
						<td class='GalleryOriginField'><div class='limiter'><?php echo h($gallery['Gallery']['origin']); ?>&nbsp;<div></td>
						<td class='GalleryScoreField'><div class='limiter'><?php echo h($gallery['Gallery']['score']); ?>&nbsp;<div></td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $gallery['Gallery']['id']), array('class' => 'btn btn-default','escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $gallery['Gallery']['id']), array('class' => 'btn btn-default', 'escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $gallery['Gallery']['id']), array('class' => 'btn btn-default', 'escape' => false), __('Are you sure you want to delete # %s?', $gallery['Gallery']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->