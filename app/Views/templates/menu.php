<?php
$uri = service('uri');
$currentPath = $uri->getPath();

function isActive($path, $currentPath)
{
    if ($path === '/' && ($currentPath === '' || $currentPath === '/'))
        return 'active';
    return (str_contains($currentPath, $path)) ? 'active' : '';
}

$menuModel = new \App\Models\MenuModel();
$menuTree = $menuModel->getTree();
?>
<section data-widget_type="widget" data-widget_name="MenusExpandableWidget"
    class="widget menus-expandable-widget max-view">
    <div class="menus-widget-container" style="--home-label:'হোম';">
        <section class="widget menu-widget">
            <button id="menu-toggle" class="hamburger-menu-block" type="button" aria-expanded="false"
                aria-controls="main-site-menu">
                <span class="hamburger-menu-main">
                    <icon class="hamburger-menu ph ph-list" aria-hidden="true"></icon>
                    <span class="hamburger-menu-label">মেনু নির্বাচন করুন</span>
                </span>
                <icon class="hamburger-menu-caret ph ph-caret-down" aria-hidden="true"></icon>
            </button>
            <ul id="main-site-menu" class="menu-list menu-parent-unordered-list custom-items-center">
                <?php foreach ($menuTree as $item): ?>
                    <?php if ($item['url'] === '/'): ?>
                        <!-- Home Icon Special Case -->
                        <li class="megamenu-link <?= isActive('/', $currentPath) ?>" style="display: flex;">
                            <a class="menu-parent-list-link home-link" href="<?= base_url() ?>" style="color: <?= esc($item['color'] ?: 'rgb(255, 69, 0)') ?>;">
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="megamenu-link <?= isset($item['children']) ? 'menu-parent-list' : '' ?> <?= isActive($item['url'], $currentPath) ?>" style="display: flex;">
                            <a title="<?= esc($item['label']) ?>" href="<?= ($item['url'] === '#' || str_starts_with($item['url'], 'http')) ? $item['url'] : base_url($item['url']) ?>" 
                               class="menu-parent-list-link" 
                               target="<?= esc($item['target']) ?>"
                               style="color: <?= esc($item['color'] ?: 'inherit') ?>;">
                                <?= esc($item['label']) ?>
                                <?php if (isset($item['children'])): ?>
                                    <icon class="menu-parent-list-link-icon ph ph-caret-double-down"></icon>
                                <?php endif; ?>
                            </a>
                            
                            <?php if (isset($item['children'])): ?>
                                <div class="mega-menu-dropdown megaMenu" style="border-top: 6px solid <?= esc($item['color'] ?: 'var(--color-primary)') ?>;">
                                    <div class="menu-child-box ">
                                        <ul class="menu-sub-child-unordered-list">
                                            <?php foreach ($item['children'] as $child): ?>
                                                <?php if (isset($child['children'])): ?>
                                                    <!-- Handling one level deeper if needed (e.g. Form sections) -->
                                                    <div class="menu-child-box ">
                                                        <h6 title="<?= esc($child['label']) ?>" class="menu-child-title"><?= esc($child['label']) ?></h6>
                                                        <ul class="menu-sub-child-unordered-list">
                                                            <?php foreach ($child['children'] as $subChild): ?>
                                                                <li class="menu-sub-child-list">
                                                                    <a title="<?= esc($subChild['label']) ?>" class="menu-sub-child-link"
                                                                       href="<?= (str_starts_with($subChild['url'], 'http')) ? $subChild['url'] : base_url($subChild['url']) ?>"
                                                                       target="<?= esc($subChild['target']) ?>">
                                                                        <div><?= esc($subChild['label']) ?></div>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                <?php else: ?>
                                                    <li class="menu-sub-child-list">
                                                        <a title="<?= esc($child['label']) ?>" class="menu-sub-child-link"
                                                           href="<?= (str_starts_with($child['url'], 'http')) ? $child['url'] : base_url($child['url']) ?>"
                                                           target="<?= esc($child['target']) ?>">
                                                            <div><?= esc($child['label']) ?></div>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>
    <button class="expand-btn" type="button" aria-expanded="false">
        <span><i class="ph ph-list"></i> আরও</span>
        <span style="display:none;"><i class="ph ph-caret-up"></i> সংক্ষিপ্ত</span>
    </button>
</section>
