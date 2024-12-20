const captions = [
     {
        zoom: "images/Italy.jpg",
        link: "./SAM/index.html",
        image: "images/Italy.jpg",
        type: "filter-web",
        title: "Italy"
    },
    {
        zoom: "images/chat.jpg",
        link: "images/chat.jpg",
        image: "images/chat.jpg",
        type: "filter-web",
        title: "Real time Chat"
    },
    {
        zoom: "images/fb.jpg",
        link: "images/fb.jpg",
        image: "images/fb.jpg",
        type: "filter-webapp",
        title: "FB Clone"
    },
    {
        zoom: "images/Net.jpg",
        link: "images/Net.jpg",
        image: "images/Net.jpg",
        type: "filter-webapp",
        title: "Net-tizenship"
    },
    {
        zoom: "images/shop.jpg",
        link: "./API/index.html",
        image: "images/shop.jpg",
        type: "filter-web",
        title: "CHANCHAN Shop"
    },
    {
        zoom: "images/sis.jpg",
        link: "images/sis.jpg",
        image: "images/sis.jpg",
        type: "filter-web",
        title: "Symptobot"
    },
    {
        zoom: "images/twitter.jpg",
        link: "images/twitter.jpg",
        image: "images/twitter.jpg",
        type: "filter-webapp",
        title: "X Clone"
    },
    {
        zoom: "images/rice.jpg",
        link: "images/rice.jpg",
        image: "images/rice.jpg",
        type: "filter-app",
        title: "Ricecue"
    },
    {
        zoom: "images/ytt.png",
        link: "./Embedd/index.html",
        image: "images/ytt.png",
        type: "filter-web",
        title: "YouTube Clone"
    },
    {
        zoom: "images/a05.png",
        link: "./A05/index.php",
        image: "images/a05.png",
        type: "filter-web",
        title: "A05"
    },
];

var row = document.getElementById("row");

for (let i = 0; i < captions.length; i++) {
    row.innerHTML += ` 
    <div class="col-lg-4 col-md-6 portfolio-item ` + captions[i].type + `" data-aos="fade-up" data-aos-delay="` + (i * 100) + `"  style="max-height:400px;">
          <div class="portfolio-content h-100">
            <img src="` + captions[i].image + `" style="max-height:300px;" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>` + captions[i].title + `</h4>
              <p>Lorem ipsum, dolor sit amet consectetur</p>
              <a href="` + captions[i].image + `" title="` + captions[i].title + `" data-gallery="portfolio-gallery-app"
                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="` + captions[i].link + `" title="More Details" class="details-link"><i
                  class="bi bi-link-45deg"></i></a>
            </div>
          </div>
        </div>
    `
}
const filters = document.querySelectorAll('.portfolio-filters li');

filters.forEach(filter => {
    filter.addEventListener('click', function() {
   
        filters.forEach(btn => btn.classList.remove('filter-active'));
        
  
        this.classList.add('filter-active');

        const filterValue = this.getAttribute('data-filter');
        
        const items = document.querySelectorAll('.portfolio-item');
        items.forEach(item => {
            if (filterValue === '*' || item.classList.contains(filterValue)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
AOS.init({
    duration: 1000,
    once: true
});
let nav = document.getElementById("nav1");
let navbar1 = document.getElementById("navbar1");
function openNav() {
    if (navbar1.style.backgroundColor == "") {
        navbar1.style.backgroundColor = "#404C56";
    } else {
        navbar1.style.backgroundColor = "";
    }
}
let scrollTop = document.querySelector('.scroll-top');

function toggleScrollTop() {
    if (scrollTop) {
        window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
}
scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

window.addEventListener('load', toggleScrollTop);
document.addEventListener('scroll', toggleScrollTop);
