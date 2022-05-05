    <?php if (function_exists('bcn_display')) : ?>
        <div class="container breadcrumb">
            <?php
            //Temporary fix wrong title in service category :)
            // if (is_tax('service_category')) {
            //     $breadcrumb = bcn_display(true);
            //     $page = get_page_by_path('pakalpojumi');
            //     $pageTitle = get_the_title($page);
            //     if (strpos($breadcrumb, $pageTitle) !== false)
            //         echo $breadcrumb;
            //     else
            //         echo str_replace($pageTitle, $pageTitle, $breadcrumb);
            // } else
                bcn_display();
            ?>
        </div>
    <?php endif; ?>