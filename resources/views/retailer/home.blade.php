<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css">
    <link href="{{ retailer_asset('css/home.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand logohome" href="#">
        <img src=" {{ asset('shop_retailer/img/logo.png') }}" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <!-- home -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark " href="#" id="home" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Home
          </a>
          <ul class="dropdown-menu" aria-labelledby="home">
            <li><a class="dropdown-item" href="#">Action</a></li>
          </ul>
        </li>
        <!-- ---- -->
        <!-- ABOUT US -->
        <li class="nav-item dropdown margin-right-header">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            About Us
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
          </ul>
        </li>
        <!-- ---- -->
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">+44 7939 928406</a>
        </li>
        <li class="nav-item ms-2">
          <a class="nav-link btn btn-primary text-white" href="#">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Banner -->
<div style="height: 100vh; background-image: url(https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80); background-size: cover; background-position: center;" class="position-relative w-100">
  <div class="position-absolute text-white d-flex flex-column align-items-start justify-content-center" style="top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0,0,0,.7);">
    <div class="container">
      <div class="col-md-6">
        <span style="color: #bbb;" class="text-uppercase">SubHeadline</span>
        <!-- on small screens remove display-4 -->
        <h1 class="mb-4 mt-2 display-4 font-weight-bold">Enter Your <span style="color: #9B5DE5;">Headline Here</span></h1>
        <p  style="color: #bbb;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem eos ea, cum quae facilis optio impedit tempora aliquam at eveniet?</p>
        <div class="mt-5">
          <!-- hover background-color: white; color: black; -->
          <a href="#" class="btn px-5 py-3 text-white mt-3 mt-sm-0" style="border-radius: 30px; background-color: #9B5DE5;">Get Started</a>
        </div>
      </div>
    </div>
  </div>
</div>
     
<!-- Credit: Componentity.com
<a href="https://componentity.com" target="_blank" class="block">
<img src="http://codenawis.com/componentity/wp-content/uploads/2020/08/logo-componentity-%E2%80%93-9.png" width="120px" class="d-block mx-auto my-5">
</a> -->
<!-- ....... -->
<div class="container section-space">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="w-70">

                <div class="service-section-one px-3">
                    <p class="text-muted">01</p>
                    <strong>Buy, sell and trade-in effortlessly</strong>
                </div>
                <p>Keep records of what you're buying and selling, supporting trading in and swaps and track your products and profit.</p>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="service-section-one px-3">
                <p class="text-muted">01</p>
                <strong>Buy, sell and trade-in effortlessly</strong>
            </div>
            <p>Keep records of what you're buying and selling, supporting trading in and swaps and track your products and profit.</p>
        </div>
        <div class="col-md-4 col-12">
            <div class="service-section-one px-3">
                <p class="text-muted">01</p>
                <strong>Buy, sell and trade-in effortlessly</strong>
            </div>
            <p>Keep records of what you're buying and selling, supporting trading in and swaps and track your products and profit.</p>
        </div>
    </div>
</div>
<div class="container section-space portfolio">
    <!-- ....HERO section -->
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="w-90">
                <h1>Complete control over buying / selling</h1>
                <p class="font-17">Track every single item that is traded-in; IMEI, condition, amount paid, customer details, and any work that is needed. Know what you have when your customers enquire and sell for a profit fast - and repeat - £££</p>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt="missing image" class="w-100">
            </div>
        </div>
    </div>    
    <!-- ....HERO section -->
    <div class="row mt-3">
        <div class="col-md-6 col-12">
            <div class="">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt="missing image" class="w-100">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="w-90">
                <h1>Stock management for everything you sell</h1>
                <p class="font-17"> You can't run a business efficiently without knowing what stock you have and what is missing. Buffalo will remind you daily what you need to restock and know exactly which supplier to return an item to if the worst happens.</p>
            </div>
        </div>
    </div>    
</div>
<hr>
<div class="container section-space">
    <p class="text-primary text-center italic">
        <em>Techbuff is for you </em>
    </p>
    <h1 class="text-center">TECHBUFF
        <span class="text-primary ">PRIORITIES</span>
    </h1>
    <div class="w-80 m-auto ">
        <div class="shadow p-3 rounded">    
            <div class="row align-items-center">
                <div class="col-md-6 col-12">
                    <div class="">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt="missing image" class="w-100">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="w-80">
                        <h3 class="pb-2">Stock management for every</h3>
                        <p>You can't run a business efficiently without knowing what stock you have and what is missing. Buffalo will remind you daily what you need to restock and know exactly which supplier to return an item to if the worst happens.</p>
                    </div>
                </div>
            </div>  
        </div>
        <!-- ...........` -->
        <div class="shadow mt-3 p-3 rounded">    
            <div class="row align-items-center">
                <div class="col-md-7 col-12">
                    <div class="w-80 px-3">
                        <h3 class="pb-2">Eeverything you sell</h3>
                        <p>At Buffalo, we build our features from the ground up, with security of your data a prime concern. We don't 
                            take shortcuts, deliver before we're ready or outsource development to other countries. Buffalo 
                            is built in-house, in the United Kingdom, by a team of engineers, adding features that are specifically 
                            needed by our community of users. We're happy to answer any questions you may have around this subject.</p>
                    </div>
                </div>
                <div class="col-md-5 col-12">
                    <div class="">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt="missing image" class="w-100">
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- ....Priorities section.......   -->
<div class="container section-space Priorities">
    <h1 class="text-center">TECHBUFF
        <span class="text-primary ">PACKAGES</span>
    </h1>
    <div class="w-80 m-auto">
        <div class="row ">
            <div class="col-md-6 col-12">
                <div class="w-90">
                    <strong>STARTER</strong>
                    <h1 class="lh-lg">£0</h1>
                    <p>Get access to all the basic features suitable for most small-scale retailers 
                        and workshops. Experiment with Buffalo App or use it forever, for free (yes, really).</p>
                        <ul>
                            <li>
                                50 repairs per month
                            </li>
                            <li>50 invoices per month</li>
                            <li>50 trade-in items per month</li>
                            <li>1 user account</li>
                            <li>£5 for 100 SMS credits</li>
                            <li>£5 for 100 SMS credits</li>
                            <li>1 user account</li>
                        </ul>
                        <button class="btn btn-dark">Sign-Up</button>
                    </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="w-90">
                    <strong class="text-primary">PRO</strong>
                    <h1 class="lh-lg text-primary">£49</h1>
                    <p>Get access to all the basic features suitable for most small-scale retailers 
                        and workshops. Experiment with Buffalo App or use it forever, for free (yes, really).</p>
                    <ul class="bluemarker">
                        <li>Unlimited repairs per month</li>
                        <li>Unlimited invoices per month</li>
                        <li>Unlimited trade-in items per month</li>
                        <li>Print receipt and labels directly to printers</li>
                        <li>100 SMS credits included (£4 per 100 for more)</li>
                        <li>Buy Now Pay Later with Klarna</li>
                        <li>Automated review invitations</li>
                    </ul>
                    <button class="btn btn-primary">Sign-Up</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- -------ASKED QUESTION------- -->
<div class="container section-space">
    <div class="accordion">
        <h1>TECHBUFF<span class="text-primary"> PACKAGES </span></h1>
        <div class="accordion-item">
            <input type="checkbox" id="accordion1">
            <label for="accordion1" class="accordion-item-title"><span class="icon"></span>What is SEO, and why is it important for online businesses?</label>
            <div class="accordion-item-desc">SEO, or Search Engine Optimization, is the practice of optimizing a website to improve its visibility on search engines like Google. It involves various techniques to enhance a site's ranking in search results. SEO is crucial for online businesses as it helps drive organic traffic, increases visibility, and ultimately leads to higher conversions.</div>
        </div>

        <div class="accordion-item">
            <input type="checkbox" id="accordion2">
            <label for="accordion2" class="accordion-item-title"><span class="icon"></span>How long does it take to see results from SEO efforts?</label>
            <div class="accordion-item-desc">The timeline for seeing results from SEO can vary based on several factors, such as the competitiveness of keywords, the current state of the website, and the effectiveness of the SEO strategy. Generally, it may take several weeks to months before noticeable improvements occur. However, long-term commitment to SEO is essential for sustained success.</div>
        </div>

        <div class="accordion-item">
            <input type="checkbox" id="accordion3">
            <label for="accordion3" class="accordion-item-title"><span class="icon"></span>What are the key components of a successful SEO strategy?</label>
            <div class="accordion-item-desc">A successful SEO strategy involves various components, including keyword research, on-page optimization, quality content creation, link building, technical SEO, and user experience optimization. These elements work together to improve a website's relevance and authority in the eyes of search engines.</div>
        </div>

        <div class="accordion-item">
            <input type="checkbox" id="accordion4">
            <label for="accordion4" class="accordion-item-title"><span class="icon"></span>How does mobile optimization impact SEO?</label>
            <div class="accordion-item-desc">Mobile optimization is crucial for SEO because search engines prioritize mobile-friendly websites. With the increasing use of smartphones, search engines like Google consider mobile responsiveness as a ranking factor. Websites that provide a seamless experience on mobile devices are more likely to rank higher in search results.</div>
        </div>

        <div class="accordion-item">
            <input type="checkbox" id="accordion5">
            <label for="accordion5" class="accordion-item-title"><span class="icon"></span>What is the role of backlinks in SEO, and how can they be acquired?</label>
            <div class="accordion-item-desc">Backlinks, or inbound links from other websites to yours, play a significant role in SEO. They are considered a vote of confidence and can improve a site's authority. Quality over quantity is crucial when acquiring backlinks. Strategies for obtaining backlinks include creating high-quality content, guest posting, reaching out to industry influencers, and participating in community activities. It's important to focus on natural and ethical link-building practices.</div>
        </div>
    </div>
</div>
<!-- -------CONTACT FORM--------- -->
<div class="section-space">
<div class="container-fluid ">
    <div class="row bg-dark align-items-center">
        <div class="col-md-6 col-12">
            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt="missing image" class="w-100">
        </div>
        <div class="col-md-6 col-12 text-white">
            <div class="container w-80">
                <h1 class="text-center">More questions?</h1>
                <p class="pt-3 pb-4">We're here for your questions so if you'd like to know more about the features available or whether 
                    Buffalo App is right for your business, drop us a message.We're also available on WhatsApp.</p>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                        <input type="text" class="form-control" id="message" placeholder="Message">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
 <!-- -------- SLICK SLIDER------ -->
 <div class="wrapper container">
      <div class="carousel">
        <div><img src="https://picsum.photos/300/200?random=1"></div>
        <div><img src="https://picsum.photos/300/200?random=2"></div>
        <div><img src="https://picsum.photos/300/200?random=3"></div>
        <div><img src="https://picsum.photos/300/200?random=4"></div>
        <div><img src="https://picsum.photos/300/200?random=5"></div>
        <div><img src="https://picsum.photos/300/200?random=6"></div>
      </div>
</div>
<!-- ------- FOOTER ------- -->
<footer class="container">
    <div class="row">
        <div class="col-md-8">
            <p>© Techbuff. All rights reserved.</p>
            <ul class="d-flex ps-0">
                <li>
                    <a href="" class="text-dark">Term & Condition</a>
                </li>
                <li>
                    <a href="" class="text-dark">Billing</a>
                </li>
                <li>
                    <a href="" class="text-dark">Support</a>
                </li>
            </ul>
        </div>
        <div class="col-md-4 col-4">

        </div>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
  $('.carousel').slick({
  slidesToShow: 4,
  dots:false,
  centerMode: false,
  });
});
</script>
</body>
</html>