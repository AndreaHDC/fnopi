{{--
 * Title: Custom Query Loop
 * Slug: fnopi-theme/query-loop
 * Categories: query
--}}

@php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
@endphp

<!-- wp:query {"queryId":1,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query">
    <!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
    <!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group">
        <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/4","width":"100%","height":"400px"} /-->

        <!-- wp:post-title {"isLink":true,"fontSize":"large"} /-->

        <!-- wp:post-excerpt {"moreText":"Read More","fontSize":"small"} /-->

        <!-- wp:post-date {"fontSize":"small"} /-->
    </div>
    <!-- /wp:group -->
    <!-- /wp:post-template -->

    <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
    <!-- wp:query-pagination-previous /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next /-->
    <!-- /wp:query-pagination -->

    <!-- wp:query-no-results -->
    <!-- wp:paragraph {"placeholder":"Add text or blocks that will display when the query returns no results."} -->
    <p>No posts found.</p>
    <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->
</div>
<!-- /wp:query -->
