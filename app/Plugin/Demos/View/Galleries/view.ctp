<div class="galleries view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3><?php echo __('Gallery'); ?></h3>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-12">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
					<tr>
						<th><?php echo __('Id'); ?></th>
						<td>
							<?php echo h($gallery['Gallery']['id']); ?>
							&nbsp;
						</td>
					</tr>
					<tr>
						<th><?php echo __('Asset Preview'); ?></th>
						<td>
							<?php echo h($gallery['Gallery']['asset_preview']); ?>
							&nbsp;
						</td>
					</tr>
					<tr>
						<th><?php echo __('Name'); ?></th>
						<td>
							<?php echo h($gallery['Gallery']['name']); ?>
							&nbsp;
						</td>
					</tr>
					<tr>
						<th><?php echo __('Origin'); ?></th>
						<td>
							<?php echo h($gallery['Gallery']['origin']); ?>
							&nbsp;
						</td>
					</tr>
					<tr>
						<th><?php echo __('Score'); ?></th>
						<td>
							<?php echo h($gallery['Gallery']['score']); ?>
							&nbsp;
						</td>
					</tr>
					<tr>
						<th><?php echo __('Created'); ?></th>
						<td>
							<?php echo h($gallery['Gallery']['created']); ?>
							&nbsp;
						</td>
					</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row well">
	<div class="col-md-12 ">
		<h3><?php echo __('Related Media'); ?></h3>
		<?php if (!empty($gallery['Media'])): ?>
			<table cellpadding = "0" cellspacing = "0" class="table gallery table-striped MediaTable">
				<thead>
					<tr>
						<th class='MediaGalleryIdField'><?php echo __('Gallery Id'); ?></th>
						<th class='MediaNameField'><?php echo __('Name'); ?></th>
						<th class='MediaAssetFileField'><?php echo __('Asset File'); ?></th>
						<th class='MediaOriginField'><?php echo __('Origin'); ?></th>
						<th class='MediaSortField'><?php echo __('Sort'); ?></th>
						<th class='MediaScoreField'><?php echo __('Score'); ?></th>
						<th class='MediaModifiedField'><?php echo __('Modified'); ?></th>
						<th class="actions"></th>
					</tr>
					<thead>
						<tbody>
							<?php foreach ($gallery['Media'] as $media): ?>
								<tr>
									<td class='MediaGalleryIdField'><div class='limiter'><?php echo h($media['gallery_id']); ?><div></td>
									<td class='MediaNameField'><div class='limiter'><?php echo h($media['name']); ?><div></td>
									<?php
									$arr = explode('.', $media['asset_file']);
									$ext = array_pop($arr);
									$prepend = strrpos($media['asset_file'], '//') === false ? Router::url('/', true) . '/files/uploads/':''; 
									$imgPath = $prepend . $media['asset_file'];
									?>
									<td class='MediaAssetFileField' style="background-image: url(<?php echo $imgPath; ?>);">
										<div class="actions">
											<span class="label label-default">Default</span>
											<span class="label label-default">Add tag..</span>

											<span style="float: right;">
												<span class="toggle-fav glyphicon glyphicon-star <?php echo $media['is_favorite'] >= 1 ? 'active':''; ?>" data-id="<?php echo $media['id']; ?>" data-value="1"  aria-hidden="true"></span>
												<span class="toggle-fav glyphicon glyphicon-star <?php echo $media['is_favorite'] >= 2 ? 'active':''; ?>" data-id="<?php echo $media['id']; ?>" data-value="2"  aria-hidden="true"></span>
												<span class="toggle-fav glyphicon glyphicon-star <?php echo $media['is_favorite'] >= 3 ? 'active':''; ?>" data-id="<?php echo $media['id']; ?>" data-value="3"  aria-hidden="true"></span>
												<span class="toggle-fav glyphicon glyphicon-star <?php echo $media['is_favorite'] >= 4 ? 'active':''; ?>" data-id="<?php echo $media['id']; ?>" data-value="4"  aria-hidden="true"></span>
												<span class="toggle-fav glyphicon glyphicon-star <?php echo $media['is_favorite'] >= 5 ? 'active':''; ?>" data-id="<?php echo $media['id']; ?>" data-value="5"  aria-hidden="true"></span>
											</span>	
										</div>
										<?php 
										echo $this->Html->link( $this->Html->image($imgPath),  $imgPath, ['target' => '_blank', 'escape' => false, 'data-fancybox-group' => 'le-group', 'class' => 'fancy'] , []); 
										?>
										&nbsp;
									</td>
									<td class='MediaOriginField'><div class='limiter'><?php echo h($media['origin']); ?><div></td>
									<td class='MediaSortField'><div class='limiter'><?php echo h($media['sort']); ?><div></td>
									<td class='MediaScoreField'><div class='limiter'><?php echo h($media['score']); ?><div></td>
									<td class='MediaModifiedField'><div class='limiter'><?php echo h($media['modified']); ?><div></td>
									<td class="actions">
										<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'media', 'action' => 'view', $media['id']), array('escape' => false)); ?>
										<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'media', 'action' => 'edit', $media['id']), array('escape' => false)); ?>
										<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'media', 'action' => 'delete', $media['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $media['id'])); ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>

				<div class="actions">
					<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Media'), array('controller' => 'media', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
				</div>
			</div><!-- end col md 12 -->
		</div>
