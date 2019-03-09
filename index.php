<?php include("includes/header.php"); ?>
<?php 
if(isset($_GET['page']) ? $page = $_GET['page'] : $page = 1);
$items_per_page = 4;
$items_total_count = Photo::count_all();
$paginate = new Paginate($page, $items_per_page, $items_total_count);
if($page > $paginate->pagesTotal() ? redirect('index.php'): false );
$photos = Photo::find_all_limited($paginate->items_per_page, $paginate->offset());
?>


<div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-12">
        <div class="thumbnails row">
        <?php foreach ($photos as $photo): ?>  
            <div class="col-xs-6 col-md-3">
                <a href="photo.php?id=<?php echo $photo->id;?>" class="thumbnail">
                    <img class="img-responsive home_page_photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
                </a>
            </div>    
        <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Pagination start -->
<?php if($paginate->items_total_count > $paginate->items_per_page){ ?>
<div class="row">
    <div id="paginate" class="col-md-12 col-xs-9">
        <ul class="pagination text-center">
            <?php if($paginate->hasPrevious()){ ?>
                <li class="previous page-item">
                <a class="page-link" href="?page=<?php echo $paginate->previous() ?>">Previous</a>
                </li>
            <?php } else { ?>    
                <li class="previous page-item disabled">            
                <span class="page-link">Previous</span>
                </li>
            <?php } ?>    

            <?php for ($i=1; $i<=$paginate->pagesTotal() ; $i++) { 
                echo "<li class='page-item" . $paginate->ifActive($i) . "'";
                echo "><a class='page-link' href='?page={$i}'>{$i}</a></li>\r\n";
            } ?>

            <?php if($paginate->hasNext()){ ?>
                <li class="next page-item">
                <a class="page-link" href="?page=<?php echo $paginate->next() ?>">Next</a>
                </li>
            <?php } else { ?>    
                <li class="next page-item disabled">            
                <span class="page-link">Next</span>
                </li>
            <?php } ?>    
        </ul>
    </div>
</div>
<?php } ?>
<!-- Pagination -->
<?php include("includes/footer.php"); ?>
