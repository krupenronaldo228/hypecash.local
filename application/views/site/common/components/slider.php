<section class="home-slider">
	<div class="home-slider-list" id="homeSlider">
	<? foreach($slider as $slide) { ?>
		<? $tag_class = 'home-slider-item';?>
		<? $tag_open = $slide['link'] != '' ? '<a href="'.(preg_match('#^(\w+:)?//#i', $slide['link']) ? $slide['link'] : base_url($slide['link'])).'" class="'.$tag_class.'" >' : '<div class="'.$tag_class.'">'?>
		<? $tag_close = $slide['link'] != '' ? '</a>' : '</div>'?>
		<?=$tag_open;?>
			<? if($slide['show_text']) { ?>
			<div class="container container-<?=$slide['align'];?>">
				<div class="description">
					<div class="title">
						<?=nl2br($slide['title']);?>
					</div>
					<? if($slide['text']) { ?>
						<div class="text"><?=nl2br($slide['text']);?></div>
					<? } ?>
					<? if($slide['btn'] != '') { ?>
					<div class="action">
						<span class="btn"><?=$slide['btn'];?></span>
					</div>
					<? } ?>
				</div>
			</div>
			<? } ?>
			<div class="image" id="homeSliderImage<?=$slide['id'];?>" style=""></div>
		<?=$tag_close;?>
	<? } ?>
	</div>
</section>

<style>
	<? foreach ($slider as $slide) { ?>

	#homeSliderImage<?=$slide['id'];?> {
		background-image: url('<?=base_url(PATH_UPLOADS.'/slider/thumb/'.$slide[Slider_model::IMG_MAIN]);?>');
	}
	<? if($slide[Slider_model::IMG_MOBILE] != '') { ?>
	@media (max-width: 500px) {
		#homeSliderImage<?=$slide['id'];?> {
			background-image: url('<?=base_url(PATH_UPLOADS.'/slider/thumb/'.$slide[Slider_model::IMG_MOBILE]);?>');
		}
	}
	<? } ?>

	<? } ?>
</style>

<script>
	$('#homeSlider').owlCarousel({
		loop: true,
		nav: true,
		items: 1,
		navText: ['<?=fa5s('angle-left');?>', '<?=fa5s('angle-right');?>'],
		dots: true,
		lazyLoad: true
	});
</script>
