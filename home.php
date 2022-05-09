<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.cars-list{
cursor: pointer;
}
span.hightlight{
    background: yellow;
}
.banner{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 26vh;
        width: calc(30%);
    }
    .banner img{
        width: calc(100%);
        height: calc(100%);
        cursor :pointer;
    }
.cars-list{
cursor: pointer;
border: unset;
flex-direction: inherit;
}

.cars-list .banner {
    width: calc(40%)
}
.cars-list .card-body {
    width: calc(60%)
}
.cars-list .banner img {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    min-height: 50vh;
    box-shadow: 1px 0 #e1e1e1;

}
span.hightlight{
    background: yellow;
}
.banner{
   min-height: calc(100%)
}
#carousel-field{
    position: fixed;
    z-index: -1;
    width: calc(100%)
}
#carousel-field, #carsCarousel, #carsCarousel .carousel-inner,#carsCarousel .carousel-item,#carsCarousel img{
    height:calc(100%);
    /*max-height: 60vh*/
} 
.masthead{
    background: unset!important;
    height:calc(80%)!important;
}
.masthead:before{
    content: unset!important;
}
</style>
        
        <div >
            <div class="container mt-3 pt-2">
                <h4 class="text-center text-white">Our Vehicles</h4>
                <hr class="divider">
                <?php
                $cat = array();
                $cat[] = '';
                $qry = $conn->query("SELECT * FROM categories ");
                while($row = $qry->fetch_assoc()){
                    $cat[$row['id']] = $row['name'];
                }
                $tt = array();
                $tt[] = '';
                $qry = $conn->query("SELECT * FROM transmission_types ");
                while($row = $qry->fetch_assoc()){
                    $tt[$row['id']] = $row['name'];
                }
                $et = array();
                $et[] = '';
                $qry = $conn->query("SELECT * FROM engine_types ");
                while($row = $qry->fetch_assoc()){
                    $et[$row['id']] = $row['name'];
                }
                $cars = $conn->query("SELECT * from cars ");
                if( $cars->num_rows > 0):
                while($row = $cars->fetch_assoc()):
                    $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                    $desc = strtr(html_entity_decode($row['description']),$trans);
                    $desc=str_replace(array("<li>","</li>"), array("",","), $desc);
                ?>
                <div class="card cars-list" data-id="<?php echo $row['id'] ?>">
                     <div class='banner'>
                        <?php if(!empty($row['img_path'])): ?>
                            <img src="admin/assets/uploads/cars_img/<?php echo($row['img_path']) ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row  align-items-center justify-content-center text-center h-100">
                            <div class="">
                                <h3><b class="filter-txt"><?php echo ucwords($row['model']) ?></b></h3>
                                <div><small><p><b><?php echo $row['brand'] ?></b></p></small></div>
                                <hr>
                                <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                                <br>
                                <span><small><i class="fa fa-circle text-primary"></i> <?php echo $cat[$row['category_id']] ?></small></span>
                                <span><small><i class="fa fa-cog text-primary"></i> <?php echo $tt[$row['transmission_id']] ?></small></span>
                                <span><small><i class="fa fa-gas-pump text-primary"></i> <?php echo $et[$row['engine_id']] ?></small></span>
                                <hr class="divider"  style="max-width: calc(80%)">
                                <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <br>
                <?php endwhile; ?>
                <?php else: ?>
                    <div class="card mb-4">
                        <div class="card-body">No upcoming cars.</div>
                    </div>
                <?php endif; ?>
                
            </div>

</div>
<script>
     $('.read_more').click(function(){
         location.href = "index.php?page=view_car&id="+$(this).attr('data-id')
     })
     $('.banner img').click(function(){
        viewer_modal($(this).attr('src'))
    })
    $('#filter').keyup(function(e){
        var filter = $(this).val()

        $('.card.cars-list .filter-txt').each(function(){
            var txto = $(this).html();
            txt = txto
            if((txt.toLowerCase()).includes((filter.toLowerCase())) == true){
                $(this).closest('.card').toggle(true)
            }else{
                $(this).closest('.card').toggle(false)
               
            }
        })
    })
</script>