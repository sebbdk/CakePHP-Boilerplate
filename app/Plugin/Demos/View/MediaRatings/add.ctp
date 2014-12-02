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
				<?php foreach ($medias as $media): ?>
					<tr>

						<td class='MediaNameField'><div class='limiter'><?php echo h($media['Media']['name']); ?>&nbsp;<div></td>


							<?php
								$arr = explode('.', $media['Media']['asset_file']);
								$ext = array_pop($arr);
								$prepend = strrpos($media['Media']['asset_file'], '://') === false ? '/files/uploads/':''; 
								$imgPath = $prepend . $media['Media']['asset_file'];
							?>
						<td class='MediaAssetFileField' style="background-image: url(<?php echo $imgPath; ?>);">
							<?php 
								echo $this->Html->link( $this->Html->image($prepend . $media['Media']['asset_file']),  $prepend . $media['Media']['asset_file'], ['target' => '_blank', 'escape' => false, 'data-fancybox-group' => 'le-group', 'class' => 'fancy'] , []); 
							?>
							&nbsp;
						</td>
						<td class=''>
							<?php echo $this->Html->link($media['Gallery']['name'], array('controller' => 'galleries', 'action' => 'view', $media['Gallery']['id']), array('target' => '_blank')); ?>
						</td>
						<td class='MediaSortField'><div class='limiter'><?php echo h($media['Media']['sort']); ?>&nbsp;<div></td>
						<td class="">
							<?php 
								echo $this->Form->create('MediaRating', ['role' => 'form', 'action' => 'add']);

								foreach ($medias as $imedia) {
									$name = $imedia === $media ? 'media_better_id':'media_worse_id';
									echo $this->Form->input($name, ['type' => 'hidden', 'value' => $imedia['Media']['id']]);
								}

								echo $this->form->submit('Rate better!', array('class' => 'btn btn-default','escape' => false));
								echo $this->Form->end();
							?>
						</td>
						<td>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'media', 'action' => 'delete', $media['Media']['id']), array('class' => 'btn btn-default', 'escape' => false), __('Are you sure you want to delete # %s?', $media['Media']['id'])); ?>
						</td>
					</tr>
					
				<?php endforeach; ?>
				</tbody>
			</table>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->