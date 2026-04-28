<div data-section_type="right" class="droppable">
    
    <?php foreach ($sections['right'] ?? [] as $section): ?>
        <?php switch ($section['section_key']):
            case 'chairman': ?>
                <?php $chairman = json_decode($section['content'], true); ?>
                <div data-widget_type="widget" data-widget_name="BlockWidget" class="widget block-widget"> 
                    <div class="block-widget-container"> 
                        <h3 class="block-widget-title"> <?= esc($section['title']) ?> </h3> 
                        <div class="block-widget-content"> 
                            <p style="text-align:center;">
                                <img alt="চেয়ারম্যান" src="<?= esc($chairman['image']) ?>" style="height:200px; width:160px; margin: 0 auto; display: block;" />
                            </p> 
                            <p style="text-align:center; font-size:16px;"><strong><?= esc($chairman['name']) ?></strong></p> 
                            <a class="btn" href="<?= base_url($chairman['link']) ?>" style="display:block; text-align:center;">বিস্তারিত</a> 
                        </div> 
                    </div> 
                </div>
                <?php break; ?>

            <?php case 'important_links': ?>
                <?php $links = json_decode($section['content'], true); ?>
                <div data-widget_type="widget" data-widget_name="ImportantLinkCardWidget" class="widget link-card-widget"> 
                    <h1 class="link-card-header"> <?= esc($section['title']) ?> </h1> 
                    <ul class="link-card-body"> 
                        <?php if (is_array($links)): foreach ($links as $link): ?>
                        <li class="link-card-list">
                            <a target="<?= esc($link['target'] ?? '_self') ?>" class="link-card-a" href="<?= str_starts_with($link['url'], 'http') ? esc($link['url']) : base_url($link['url']) ?>">
                                <?= esc($link['label']) ?>
                            </a>
                        </li> 
                        <?php endforeach; endif; ?>
                    </ul> 
                    <div class="all-btn"> <a href="<?= base_url('pages/external-links') ?>"> সকল </a> </div> 
                </div>
                <?php break; ?>

            <?php case 'hotline': ?>
                <?php $hotline = json_decode($section['content'], true); ?>
                <div data-widget_type="widget" data-widget_name="BlockWidget" class="widget block-widget"> 
                    <div class="block-widget-container"> 
                        <h3 class="block-widget-title"> <?= esc($section['title']) ?> </h3> 
                        <div class="block-widget-content"> 
                            <p style="text-align:center;">
                                <a href="<?= esc($hotline['url'] ?? '#') ?>" target="_blank">
                                    <img alt="জরুরি হেল্পলাইন নম্বর" src="<?= str_starts_with($hotline['image'] ?? '', 'http') ? esc($hotline['image']) : base_url($hotline['image'] ?? '') ?>" style="width:100%; max-width: 220px;" />
                                </a>
                            </p> 
                        </div> 
                    </div> 
                </div>
                <?php break; ?>

            <?php default: ?>
                <!-- Custom HTML/Widget sections -->
                <?php if ($section['type'] === 'html'): ?>
                    <div class="widget block-widget">
                        <?= $section['content'] ?>
                    </div>
                <?php endif; ?>
        <?php endswitch; ?>
    <?php endforeach; ?>
    
</div>
