<?php
class personality
{
    public $name;
    public $id;
    public $shortDescription;
    public $longDescription;
    public $color;
    public $image;
    public $status;
    public $contentImage;
    public $contentText;
    public $contentColor;

    // Constructor for initializing personality data
    public function __construct($name, $id, $shortDescription, $longDescription, $color, $image, $status, $contentImage, $contentText, $contentColor)
    {
        $this->name = $name;
        $this->id = $id;
        $this->shortDescription = $shortDescription;
        $this->longDescription = $longDescription;
        $this->color = $color;
        $this->image = $image;
        $this->status = $status;
        $this->contentImage = $contentImage;
        $this->contentText = $contentText;
        $this->contentColor = $contentColor;
    }

    // Generate HTML for the personality card
    public function cards()
    {
        // Check if the content is a video or an image
        if (pathinfo($this->contentImage, PATHINFO_EXTENSION) === 'mp4') {
            $contentHtml = '
                <video controls class="post-card img-fluid" style="width: 100%; height: 100%; border-radius: 8px;">
                    <source src="' . $this->contentImage . '" type="video/mp4">
                    Your browser does not support the video tag.
                </video>';
        } else {
            $contentHtml = '
                <img src="' . $this->contentImage . '" class="post-card img-fluid" style="width: 100%; height: 100%; border-radius: 8px;" alt="Post Image">';
        }
        
        return ' 
        <div class="posts">
            <div class="card" style="border-color:' . $this->color . ';">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color:' . $this->color . ';">
                    <div>
                        <img src="images/chanchannnnn.jpg" class="rounded-circle me-2" alt="Avatar" style="width:40px;">
                        <strong>' . $this->name . '</strong>
                    </div>
                    <small class="text-muted">' . $this->shortDescription . '</small>
                </div>
                <div class="card-body">
                    <p>' . $this->contentText . '</p>
                    <div class="row">
                        <div class="col-12" style="height:800px; width:900px; overflow-y:hidden;">
                            ' . $contentHtml . '
                        </div>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-outline-primary btn-sm"><i class="fas fa-thumbs-up"></i> Like</button>
                        <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-comment"></i> Comment</button>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
    

    
    public function accords($isFirst = false)
{
    $showClass = $isFirst ? ' show' : ''; 
    $expanded = $isFirst ? 'true' : 'false'; 
    return ' 
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading' . $this->id . '">
            <button class="accordion-button' . ($isFirst ? '' : ' collapsed') . '" 
                type="button" 
                data-bs-toggle="collapse"
                data-bs-target="#' . $this->id . '" 
                aria-expanded="' . $expanded . '">
                <i class="fas fa-circle-notch me-2"></i> ' . $this->name . '
            </button>
         </h2>
         <div id="' . $this->id . '" class="accordion-collapse collapse' . $showClass . '" 
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <p>' . $this->longDescription . '</p>
            </div>
        </div>
    </div>
    ';
}

    public function interest()
    {
        return ' 
        <span class="badge" style="background-color:' . $this->color . ';" >' . $this->name . '</span>
        ';
  
      } 
     }
?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Select all .col-12 elements inside .posts
        const postCards = document.querySelectorAll(".posts .card-body .col-12");

        function adjustStyles() {
            postCards.forEach((postCard) => {
                const image = postCard.querySelector('img.post-card');
                // Check if the viewport width is less than or equal to 768px (mobile view)
                if (window.innerWidth <= 768) {
                    if (image) {
                        image.style.height = "auto";
                    }
                    // Remove inline styles for mobile view
                    postCard.style.height = "";
                    postCard.style.width = "";
                    postCard.style.overflowY = "";
                } else {
                    // Reapply styles for larger screens
                    postCard.style.height = "800px";
                    postCard.style.width = "900px";
                    postCard.style.overflowY = "hidden";

                    if (image) {
                        image.style.height = "100%"; // Set image height to 100% on larger screens
                    }
                }
            });
        }

        // Run on page load
        adjustStyles();

        // Run on window resize
        window.addEventListener("resize", adjustStyles);
    });
</script>
