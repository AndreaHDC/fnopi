{{--
 * Title: FNOPI Post Template
 * Slug: fnopi-theme/post-template
 * Categories: post
--}}

@php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
@endphp

<!-- wp:group {"className":"fnopi-post-template","layout":{"type":"constrained"}} -->
<div class="wp-block-group fnopi-post-template">
    <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","width":"100%","height":"auto"} /-->

    <!-- wp:group {"className":"post-meta","layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group post-meta">
        <!-- wp:post-date {"fontSize":"small"} /-->
        <!-- wp:post-terms {"term":"category","fontSize":"small"} /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:post-title {"level":1,"fontSize":"large"} /-->

    <!-- wp:post-excerpt {"moreText":"Read More","fontSize":"medium"} /-->

    <!-- wp:group {"className":"post-content","layout":{"type":"constrained"}} -->
    <div class="wp-block-group post-content">
        <!-- wp:post-content /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"post-footer","layout":{"type":"flex","justifyContent":"space-between"}} -->
    <div class="wp-block-group post-footer">
        <!-- wp:post-terms {"term":"post_tag","fontSize":"small"} /-->
        <!-- wp:post-author {"showAvatar":false,"fontSize":"small"} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->
