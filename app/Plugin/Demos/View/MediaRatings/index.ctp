<div class="media index">

	<h1 style="text-align: center;">Which is better?</h1>

	<br />

	<div class="row">
				<div>
			<table cellpadding="0" cellspacing="0" class="table rating gallery table-striped MediaTable">
				<thead>
					<tr>
						<th class="MediaGalleryIdField"><?php echo $this->Paginator->sort('gallery_id'); ?></th>
						<th class="MediaNameField"><?php echo $this->Paginator->sort('name'); ?></th>
						<th class="MediaAssetFileField"><?php echo $this->Paginator->sort('asset_file'); ?></th>
						<th class="MediaOriginField"><?php echo $this->Paginator->sort('origin'); ?></th>
						<th class="MediaSortField"><?php echo $this->Paginator->sort('sort'); ?></th>
						<th class="MediaScoreField"><?php echo $this->Paginator->sort('score'); ?></th>
						<th class="MediaModifiedField"><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($media as $media): ?>
					<tr>
								<td class='MediaGalleryIdField'>
			<?php echo $this->Html->link($media['Gallery']['name'], array('controller' => 'galleries', 'action' => 'view', $media['Gallery']['id'])); ?>
		</td>
						<td class='MediaNameField'><div class='limiter'><?php echo h($media['Media']['name']); ?>&nbsp;<div></td>
							<td class='MediaAssetFileField'>
								<div class='limiter'>
									<?php 
										$arr = explode('.', $media['Media']['asset_file']);
										$ext = array_pop($arr);
										$prepend = strrpos($media['Media']['asset_file'], '://') === false ? '/files/uploads/':''; 
										if(in_array($ext, ['png', 'gif', 'jpg', 'jpeg'])) {
											echo $this->Html->link( $this->Html->image($prepend . $media['Media']['asset_file']),  $prepend . $media['Media']['asset_file'], ['target' => '_blank', 'escape' => false, 'data-fancybox-group' => 'le-group', 'class' => 'fancy'] , []); 
										} else {
											echo $this->Html->link( h($media['Media']['asset_file']),  $prepend . $media['Media']['asset_file'], ['target' => '_blank'] ); 
										}
									?>
									&nbsp;
								</div>
							</td>
						<td class='MediaOriginField'><div class='limiter'><?php echo h($media['Media']['origin']); ?>&nbsp;<div></td>
						<td class='MediaSortField'><div class='limiter'><?php echo h($media['Media']['sort']); ?>&nbsp;<div></td>
						<td class='MediaScoreField'><div class='limiter'><?php echo h($media['Media']['score']); ?>&nbsp;<div></td>
						<td class="">
							<?php echo $this->Html->link('Rate better!', array('action' => 'view', $media['Media']['id']), array('class' => 'btn btn-default','escape' => false)); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->