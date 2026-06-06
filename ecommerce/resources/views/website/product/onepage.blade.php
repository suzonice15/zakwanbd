<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>লা'আম কালোজিরা মিশ্রণ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
    }

    .section-bg {
      background: #064e03;
      padding: 30px 0;
      color: white;
      text-align: center;
    }

    .section-bg-other {
      background: #028833;
      padding: 30px 0;
      color: white;
      text-align: center;
    }

    .title-box {
      display: inline-block;
      border: 2px solid #ffd700;
      padding: 15px 30px;
      border-radius: 10px;
      font-weight: bold;
      font-size: 22px;
      margin-bottom: 15px;
    }

    .sub-text {
      font-size: 16px;
      line-height: 1.8;
      margin-bottom: 15px;
      color: #e8f5e9;
    }

    .video-box {
      border: 3px solid #ffd700;
      border-radius: 12px;
      overflow: hidden;
      margin: 0 auto 30px;
      background: #000;
    }

    .btn-order {
      background: linear-gradient(135deg, #00c853, #00a844);
      color: white;
      padding: 14px 0;
      border-radius: 50px;
      border: none;
      font-weight: bold;
      font-size: 17px;
      cursor: pointer;
      margin-top: 20px;
      display: block;
      width: 300px;
      max-width: 100%;
      text-align: center;
      margin-left: auto;
      margin-right: auto;
      box-shadow: 0 4px 15px rgba(0, 200, 83, 0.4);
      animation: pulse 2s infinite;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-order:hover {
      background: linear-gradient(135deg, #00b347, #009a3d);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 200, 83, 0.5);
    }

    @keyframes  pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(0, 200, 83, 0.5);
      }

      70% {
        box-shadow: 0 0 0 10px rgba(0, 200, 83, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(0, 200, 83, 0);
      }
    }

    .content-box {
      border: 2px solid #ffd700;
      border-radius: 15px;
      padding: 30px;
      margin-bottom: 30px;
      text-align: left;
    }

    .list-item {
      padding: 15px 0;
      border-bottom: 1px dashed #ffd700;
      font-size: 17px;
      line-height: 1.6;
    }

    .list-item:last-child {
      border-bottom: none;
    }

    .list-item i {
      color: #ffd700;
      margin-right: 10px;
    }

    /* Certificate */
    .cert-section {
      padding: 50px 0;
      background-color: #f9f9f9;
    }

    .carousel-item img {
      height: 500px;
      object-fit: contain;
    }

    #reviewCarousel .carousel-item img {
      height: auto;
      object-fit: contain;
    }

    .section-title {
      text-align: center;
      margin-bottom: 30px;
      font-weight: bold;
    }

    /* Usage */
    .usage-section {
      background: #064e03;
      padding: 80px 0;
      color: white;
    }

    .instructions {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      text-align: left;
    }

    .instructions .btn-order {
      margin-left: 0;
    }

    .rule-title {
      font-size: 30px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .rule-item {
      font-size: 18px;
      margin: 8px 0;
    }

    .product-card {
      /* background: white; */
      /* color: #333; */
      border-radius: 20px;
      padding: 20px;
      text-align: center;
    }

    .product-card img {
      width: 100%;
      max-width: 400px;
      height: auto;
      border-radius: 10px;
    }

    /* Reviews */
    .stars {
      color: #ffd700;
      font-size: 30px;
      margin: 20px 0;
      font-weight: bold;
    }

    .media-box {
      background: #000;
      border: 2px solid #ffd700;
      border-radius: 10px;
      overflow: hidden;
      height: 240px;
    }

    .review-img {
      border: 2px solid #ffd700;
      border-radius: 10px;
      height: 250px;
      width: 100%;
      object-fit: cover;
    }

    /* Pricing */
    .pricing-section {
      background: #064e03;
      padding: 60px 0;
      color: white;
      text-align: center;
    }

    .price-card {
      border: 2px solid #ffd700;
      padding: 25px;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .price-title {
      font-size: 20px;
      font-weight: bold;
    }

    .message-text {
      font-size: 17px;
      line-height: 1.8;
      margin-bottom: 20px;
      text-align: left;
    }

    .delivery-offer {
      font-size: 26px;
      font-weight: bold;
      color: #ffd700;
      margin-bottom: 20px;
      text-align: center;
    }

    .btn-order-now {
      background: linear-gradient(135deg, #00c853, #00a844);
      color: white;
      padding: 14px 0;
      border-radius: 50px;
      border: 2px solid #ffd700;
      font-weight: bold;
      font-size: 17px;
      cursor: pointer;
      display: block;
      width: 300px;
      max-width: 100%;
      text-align: center;
      margin: 20px auto 0;
      box-shadow: 0 4px 15px rgba(0, 200, 83, 0.4);
      animation: pulse 2s infinite;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-order-now:hover {
      background: linear-gradient(135deg, #00b347, #009a3d);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 200, 83, 0.5);
    }

    .order-card {
      background: white;
      border: 2px solid #064e03;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(6,78,3,0.1);
    }

    /* Order Form */
    .order-form-section {
      padding: 50px 0;
      background-color: #f9fff9;
    }

    .header-box {
      border: 2px solid #064e03;
      padding: 15px 25px;
      border-radius: 50px;
      text-align: center;
      font-weight: bold;
      margin-bottom: 35px;
      font-size: 16px;
      color: #064e03;
    }

    .form-container {
      border: none;
      padding: 5px;
      border-radius: 12px;
      background: white;
    }

    .input-field {
      width: 100%;
      padding: 11px 14px;
      margin-top: 6px;
      border: 1px solid #064e03;
      border-radius: 8px;
      font-size: 15px;
    }

    .input-field.error {
      border-color: red;
    }

    .submit-btn {
      background: linear-gradient(135deg, #064e03, #086604);
      color: white;
      padding: 14px 30px;
      border-radius: 50px;
      border: none;
      font-weight: bold;
      width: 100%;
      font-size: 16px;
      cursor: pointer;
      margin-top: 12px;
    }

    .submit-btn:hover {
      background: linear-gradient(135deg, #086604, #0a7a06);
    }

    .order-summary {
      background: #f0fff0;
      padding: 20px;
      border-radius: 10px;
      border: 1px solid #c8e6c9;
    }

    .custom-product-card {
      cursor: pointer;
      transition: border-color 0.2s, background 0.2s;
      height: 100%;
      display: flex;
      align-items: center;
      gap: 15px;
      position: relative;
    }

    .custom-product-card.selected {
      border-color: #064e03 !important;
      background: #f0fff0;
    }

    .custom-product-card img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 10px;
      flex-shrink: 0;
      display: block;
    }

    .custom-product-card label {
      cursor: pointer;
      flex: 1;
    }

    /* Footer */
    .footer-section {
      background-color: #043602;
      padding: 35px 20px;
      color: white;
      text-align: center;
    }

    @media (max-width: 767px) {
      .section-bg {
        padding: 40px 0;
      }

      .section-bg-other {
        padding: 40px 0;
      }

      .usage-section {
        padding: 50px 0;
      }

      .pricing-section {
        padding: 40px 0;
      }

      .title-box {
        font-size: 17px;
        padding: 12px 18px;
      }

      .rule-title {
        font-size: 22px;
      }

      .rule-item {
        font-size: 15px;
      }

      .delivery-offer {
        font-size: 20px;
      }

      .message-text {
        text-align: center;
      }

      .review-img {
        height: 160px;
      }

      .btn-order,
      .btn-order-now {
        width: 100%;
      }

      .price-card {
        margin-bottom: 15px;
      }

      .form-container {
        padding: 18px;
      }

      .carousel-item img {
        height: 220px;
      }

      #reviewCarousel .carousel-item img {
        height: auto;
        object-fit: contain;
      }

    }
  </style>
</head>

<body>

  <!-- Section 1: Hero -->
  <div class="section-bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <div class="title-box">
            হাজার হাজার টাকা অসুস্থ হয়ে নষ্ট করবেন কিন্তু কোন সমাধান পাননি?
          </div>
          <p class="sub-text">
            অসুস্থ হলেই বোঝা যায় সুস্থতা আল্লাহর কত বড় নেয়ামত! ৭০০০০+ মানুষ লা'আমের কালোজিরা মিশ্রন খেয়ে মুক্তি লাভ
            করেছে বিভিন্ন রোগ থেকে আলহামদুলিল্লাহ।
          </p>
          <div class="video-box">
            <div class="ratio ratio-16x9">
		        	<iframe width="560" height="300" src="https://www.youtube.com/embed/9p1ffoqTdiQ?autoplay=1&mute=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>            </div>
          </div>
          <button class="btn-order">👍 অর্ডার করতে ক্লিক করুন</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Section 2: Benefits -->
  <div class="section-bg-other">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <div class="title-box">
            লা'আম কালোজিরা রসুন মধু এবং ইরানী জাফরান মসলা মিশ্রণ টি আপনি কেন খাবেন?
          </div>
          <div class="content-box">
            <div class="list-item"><i class="fas fa-check-circle"></i> শারীরিক দুর্বলতা বা যৌ*ন দুর্বলতা দূর করে আপনাকে
              উপহার দিবে সুখময় দাম্পত্য জীবন।</div>
            <div class="list-item"><i class="fas fa-check-circle"></i> শরীরে প্রচন্ড যন্ত্রণাদায়ক ব্যাথা অথবা বাত
              ব্যাথা দূর করে আপনার জীবনকে দিবে প্রশান্তি।</div>
            <div class="list-item"><i class="fas fa-check-circle"></i> যাদের সব সময় ঠান্ডা লেগেই থাকে তাদেরকেও মুক্তি
              দিবে এই যন্ত্রণা দায়ক রোগ থেকে।</div>
            <div class="list-item"><i class="fas fa-check-circle"></i> গ্যাস্ট্রিকের কারনে বুক জ্বালাপোড়া করে বা পেট
              ফাফা দিয়ে থাকে তাদের জন্য রয়েছে দারুন উপকারিতা।</div>
            <div class="list-item"><i class="fas fa-check-circle"></i> হার্ট ব্লক বা হার্ট এর সমস্যা যাদের আছে তাদের
              জন্য এককথায় মহাঔষধ।</div>
            <div class="list-item"><i class="fas fa-check-circle"></i> যাদের উচ্চরক্তচাপ বা হাই প্রেশার রয়েছে তাদের
              জন্য প্রাকৃতিক সমাধান।</div>
            <div class="list-item"><i class="fas fa-check-circle"></i> ডায়াবেটিকস রোগীরাও সেবন করতে পারবে ইনশাআল্লাহ।
            </div>
            <div class="list-item"><i class="fas fa-check-circle"></i> নিয়মিত ৩ মাস সেবন করলে আপনি ভিতর থেকে সুস্থ হয়ে
              উঠবেন।</div>
          </div>
          <button class="btn-order"><i class="fas fa-hand-point-right"></i> অর্ডার করতে ক্লিক করুন</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Section 3: Certificates -->
  <div class="cert-section">
    <div class="container">
      <h2 class="section-title">ISO এবং BSTI ও BCSIR থেকে সার্টিফাইড</h2>
      <div id="certCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://laambd.shop/wp-content/uploads/2026/03/file_000000006018720bba03dp59eca04aa9f-1.jpg"
              class="d-block w-100" alt="BSTI Certificate">
          </div>
          <div class="carousel-item">
            <img
              src="https://laambd.shop/wp-content/uploads/2025/12/f1f21e00-e04e-46be-a08b-26b7c3931521-e1725539506797-1.jpeg"
              class="d-block w-100" alt="BCSIR Certificate">
          </div>
          <div class="carousel-item">
            <img src="https://laambd.shop/wp-content/uploads/2025/12/Untitled-design-10-1-1-1.jpg" class="d-block w-100"
              alt="ISO Certificate">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#certCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" style="background-color:#064e03;"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#certCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" style="background-color:#064e03;"></span>
        </button>
      </div>
    </div>
  </div>


  <!-- Section 4: Usage Instructions -->
  <div class="section-bg-other">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-5 instructions mb-4 mb-md-0">
          <div class="rule-title">খাওয়ার নিয়মাবলীঃ</div>
          <div class="rule-item"><i class="fas fa-check-circle me-2" style="color:#ffd700;"></i>সকালে নাস্তা খাওয়ার আগে
            এক চামচ।</div>
          <div class="rule-item"><i class="fas fa-check-circle me-2" style="color:#ffd700;"></i>রাতে খাবারের পরে দুই
            চামচ।</div>
          <button class="btn-order"><i class="fa-regular fa-hand-point-right"></i> অর্ডার করতে ক্লিক করুন</button>
        </div>
        <div class="col-12 col-md-5">
          <div class="product-card">
            <img
              src="https://laambd.shop/wp-content/uploads/2025/12/WhatsApp-Image-2025-08-05-at-3.36.12-AM-1-1024x1024.jpeg"
              alt="Product Image">
          </div>
        </div>
        <div class="col-md-1"></div>

      </div>
    </div>
  </div>


  <!-- Section 5: Reviews -->
  <div class="section-bg">
    <div class="container">
      <h4 class="mb-2">এটি সম্পূর্ণ হোমমেড একটি প্রোডাক্ট তাই কোন পার্শ্ব প্রতিক্রিয়া নেই। <span
          style="color:#ffd700;">লিমিটেড স্টক, তাই দেরি না করে এখন-ই অর্ডার করুন।</span></h4>
      <button class="btn-order"><i class="fa-regular fa-hand-point-right"></i> অর্ডার করতে ক্লিক করুন</button>

      <div class="stars mt-4">★★★ সম্মানিত কাস্টমারদের মতামত ★★★</div>

      <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-4 mb-3">
          <div class="media-box">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/9p1ffoqTdiQ?autoplay=1&mute=0" frameborder="0"
              allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-12 col-md-8">
          <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row g-2">
                  <div class="col-4"><img
                      src="https://laambd.shop/wp-content/uploads/2025/12/1bdc925d-202c-4892-b69a-54ae1efa362f-1.jpeg"
                      class="review-img" alt="Review 1"></div>
                  <div class="col-4"><img
                      src="https://laambd.shop/wp-content/uploads/2025/12/1bdc925d-202c-4892-b69a-54ae1efa362f-1.jpeg"
                      class="review-img" alt="Review 2"></div>
                  <div class="col-4"><img
                      src="https://laambd.shop/wp-content/uploads/2025/12/1bdc925d-202c-4892-b69a-54ae1efa362f-1.jpeg"
                      class="review-img" alt="Review 3"></div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row g-2">
                  <div class="col-4"><img
                      src="https://laambd.shop/wp-content/uploads/2025/12/1bdc925d-202c-4892-b69a-54ae1efa362f-1.jpeg"
                      class="review-img" alt="Review 4"></div>
                  <div class="col-4"><img
                      src="https://laambd.shop/wp-content/uploads/2025/12/1bdc925d-202c-4892-b69a-54ae1efa362f-1.jpeg"
                      class="review-img" alt="Review 5"></div>
                  <div class="col-4"><img
                      src="https://laambd.shop/wp-content/uploads/2025/12/1bdc925d-202c-4892-b69a-54ae1efa362f-1.jpeg"
                      class="review-img" alt="Review 6"></div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row g-2">
                  <div class="col-4"><img
                      src="https://laambd.shop/wp-content/uploads/2025/12/1bdc925d-202c-4892-b69a-54ae1efa362f-1.jpeg"
                      class="review-img" alt="Review 7"></div>
                  <div class="col-4"><img
                      src="https://laambd.shop/wp-content/uploads/2025/12/1bdc925d-202c-4892-b69a-54ae1efa362f-1.jpeg"
                      class="review-img" alt="Review 8"></div>
                  <div class="col-4"><img
                      src="https://laambd.shop/wp-content/uploads/2025/12/1bdc925d-202c-4892-b69a-54ae1efa362f-1.jpeg"
                      class="review-img" alt="Review 9"></div>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel"
              data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel"
              data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
          </div>
        </div>
      </div>

      <button class="btn-order mt-4"><i class="fa-regular fa-hand-point-right"></i> অর্ডার করতে ক্লিক করুন</button>
    </div>
  </div>


  <!-- Section 6: Pricing -->
  <div class="section-bg-other">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="price-card">
            <div class="price-title">৫০০ গ্রাম লা'আম কালোজিরা মিশ্রণ এর অফার প্রাইস ৯৮০ টাকা।</div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="price-card">
            <div class="price-title">১ কেজি লা'আম কালোজিরা মিশ্রণ এর অফার প্রাইস ১৫৮০ টাকা।</div>
          </div>
        </div>
      </div>
      <div class="row mt-4 align-items-center">
        <div class="col-12 col-md-6 message-text">
          লা'আম ১ মাসের জন্য ১ কেজির কোর্স অর্ডার করা উত্তম, আল্লাহর ওপর ভরসা করে আমাদের নিয়ম অনুযায়ী কন্টিনিউ সেবন
          করলে আল্লাহ রব্বুল আলামীন সুস্থতা দান করবেনই করবেন ইনশাআল্লাহ।
        </div>
        <div class="col-12 col-md-6 delivery-offer">
          এখন অর্ডার করলে<br>হোম ডেলিভারি চার্জ ফ্রি।
        </div>
      </div>
      <button class="btn-order"><i class="fa-regular fa-hand-point-right"></i> অর্ডার করতে ক্লিক করুন</button>
    </div>
  </div>


  <!-- Section 7: Order Form -->
  <div class="order-form-section">
    <div class="container">
      <div class="header-box"><h4>অর্ডার করতে আপনার সঠিক তথ্য দিয়ে নিচের ফরমটি সম্পূর্ণ পূরণ করুন</h4></div>

    <div class="order-card">

      <!-- Product Selection -->
      <div class="mb-4">
        <h5 class="fw-bold mb-3">পরিমান সিলেক্ট করুন</h5>
        <div class="row g-3">
          <div class="col-12 col-md-6">
            <div class="custom-product-card selected border p-3 rounded" id="card_500g" onclick="selectProduct('500g')">
              <img
                src="https://laambd.shop/wp-content/uploads/2025/12/74826f22-90e9-4aa5-b3a3-91ee77d209ee-300x300-1.jpeg"
                alt="500g Product">
              <input type="radio" name="product_select" id="product_500g" value="500g" checked>
              <label for="product_500g" class="ms-2">
                <strong>লা'আম কালোজিরা মধু এবং ইরানী জাফরান মসলা ৫০০ গ্রাম</strong><br>
                <small>ডেলিভারি চার্জ ফ্রি</small><br>
                <span class="text-success fw-bold">৯৮০.০০৳</span>
              </label>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="custom-product-card border p-3 rounded position-relative" id="card_1kg"
              onclick="selectProduct('1kg')">
              <span class="badge bg-danger" style="position:absolute; top:-10px; right:10px; font-size:12px; padding:6px 12px; border-radius:20px; box-shadow:0 2px 6px rgba(0,0,0,0.2);">🔥 Best Selling</span>
              <img
                src="https://laambd.shop/wp-content/uploads/2025/12/74826f22-90e9-4aa5-b3a3-91ee77d209ee-300x300-1.jpeg"
                alt="1kg Product">
              <input type="radio" name="product_select" id="product_1kg" value="1kg">
              <label for="product_1kg" class="ms-2">
                <strong>লা'আম কালোজিরা মধু এবং ইরানী জাফরান মসলা ১ কেজি</strong><br>
                <small>ডেলিভারি চার্জ ফ্রি</small><br>
                <span class="text-success fw-bold">১,৫৮০.০০৳</span>
              </label>
            </div>
          </div>
        </div>
      </div>

      <!-- Billing Form -->
      <div class="form-container">
        <div class="row g-4">
          <div class="col-12 col-md-7">
            <h5 class="mb-3">বিলিং এড্রেস</h5>

            <label>আপনার নাম লিখুন *</label>
            <input type="text" id="customerName" class="input-field" placeholder="নাম লিখুন">
            <small class="text-danger d-none" id="nameError">নাম লিখুন</small>

            <label class="mt-3 d-block">আপনার মোবাইল নাম্বার লিখুন *</label>
            <input type="tel" id="customerPhone" class="input-field" placeholder="মোবাইল নাম্বার লিখুন">
            <small class="text-danger d-none" id="phoneError">সঠিক মোবাইল নাম্বার লিখুন (১১ ডিজিট)</small>

            <label class="mt-3 d-block">আপনার সম্পূর্ণ ঠিকানা লিখুন *</label>
            <textarea id="customerAddress" class="input-field" rows="3"
              placeholder="ঠিকানা লিখুন থানা ও জেলা সহ"></textarea>
            <small class="text-danger d-none" id="addressError">ঠিকানা লিখুন</small>
          </div>

          <div class="col-12 col-md-5">
            <h5 class="mb-3">আপনার অর্ডার</h5>
            <div class="order-summary">
              <p id="summaryProduct">Product: লা'আম কালোজিরা মধু... ৫০০গ্রাম x 1 <b>৯৮০.০০৳</b></p>
              <hr>
              <p>Total: <b id="summaryTotal">৯৮০.০০৳</b></p>
              <p><small>ক্যাশ অন ডেলিভারি</small></p>
              <button class="submit-btn" onclick="submitOrder()"> <i class="fa-regular fa-hand-point-right"></i> এখানে ক্লিক করে অর্ডার টি সম্পন্ন করুন</button>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /order-card -->
    </div>
  </div>


  <!-- Footer -->
  <div class="footer-section">
    <div
      style="border:2px solid #ffd700; display:inline-block; padding:10px 25px; border-radius:25px; margin-bottom:20px;">
      যেকোন প্রয়োজনে যোগাযোগ করুন : 📞 +880 1606-700289
    </div>
    <div style="margin-top:15px;">
      <a href="#" style="color:white; margin:0 10px; text-decoration:none;">Privacy Policy</a> |
      <a href="#" style="color:white; margin:0 10px; text-decoration:none;">Terms & conditions</a>
      <p style="margin-top:12px; color:#a5d6a7;">Copyright © 2023 Laam BD | All Rights Reserved</p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const products = {
      '500g': { label: "লা'আম কালোজিরা মধু... ৫০০গ্রাম x 1", price: '৯৮০.০০৳' },
      '1kg': { label: "লা'আম কালোজিরা মধু... ১কেজি x 1", price: '১,৫৮০.০০৳' }
    };

    function selectProduct(type) {
      document.getElementById(type === '500g' ? 'product_500g' : 'product_1kg').checked = true;
      document.getElementById('card_500g').classList.toggle('selected', type === '500g');
      document.getElementById('card_1kg').classList.toggle('selected', type === '1kg');
      document.getElementById('summaryProduct').innerHTML = 'Product: ' + products[type].label + ' <b>' + products[type].price + '</b>';
      document.getElementById('summaryTotal').textContent = products[type].price;
    }

    function submitOrder() {
      let valid = true;
      const name = document.getElementById('customerName');
      const phone = document.getElementById('customerPhone');
      const address = document.getElementById('customerAddress');

      [name, phone, address].forEach(f => f.classList.remove('error'));
      document.querySelectorAll('.text-danger').forEach(e => e.classList.add('d-none'));

      if (!name.value.trim()) {
        name.classList.add('error');
        document.getElementById('nameError').classList.remove('d-none');
        valid = false;
      }
      if (!phone.value.trim() || !/^[0-9]{11}$/.test(phone.value.trim())) {
        phone.classList.add('error');
        document.getElementById('phoneError').classList.remove('d-none');
        valid = false;
      }
      if (!address.value.trim()) {
        address.classList.add('error');
        document.getElementById('addressError').classList.remove('d-none');
        valid = false;
      }
      if (valid) {
        alert('আপনার অর্ডার সফলভাবে জমা হয়েছে! আমরা শীঘ্রই যোগাযোগ করব।');
      }
    }
  </script>
</body>

</html>