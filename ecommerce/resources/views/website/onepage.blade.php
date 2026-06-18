<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $product->seo_title ?? $product->product_title }}</title>
  <meta name="description" content="{{ $product->seo_content ?? '' }}">
  <meta name="keywords" content="{{ $product->seo_keywords ?? '' }}">
  <meta property="og:title" content="{{ $product->seo_title ?? $product->product_title }}">
  <meta property="og:description" content="{{ $product->seo_content ?? '' }}">
  <meta property="og:image" content="{{ url('/') }}/public/uploads/{{ $product->folder }}/{{ $product->feasured_image }}">
  <meta property="og:type" content="product">
  <meta property="og:url" content="{{ url()->current() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{url('/assets/font_end/css/one_page_style.css')}}" rel="stylesheet">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
</head>

<body>

  {{-- Section 1: Hero --}}
  <div class="section-bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          @if($product->one_page_title)
          <div class="title-box">{{ $product->one_page_title }}</div>
          @endif
          @if($product->one_page_subtitle)
          <p class="sub-text">{{ $product->one_page_subtitle }}</p>
          @endif
          @if($product->product_video)
          <div class="video-box">
            <div class="ratio ratio-16x9">
              <iframe src="https://www.youtube.com/embed/{{ $product->product_video }}?autoplay=1&mute=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
          @endif
          <a href="#order-form" class="btn-order"><i class="fas fa-hand-point-right"></i> অর্ডার করতে ক্লিক করুন</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Section 2: Why / Benefits --}}
  @if($product->one_page_why || $product->one_page_description)
  <div class="section-bg-other">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          @if($product->one_page_why)
          <div class="title-box">{{ $product->one_page_why }}</div>
          @endif
          @if($product->one_page_description)
          <div class="content-box">
            @foreach(explode("\n", $product->one_page_description) as $line)
            @if(trim($line))
            <div class="list-item"><i class="fas fa-check-circle"></i> {{ trim($line) }}</div>
            @endif
            @endforeach
          </div>
          @endif
          <a href="#order-form" class="btn-order"><i class="fas fa-hand-point-right"></i> অর্ডার করতে ক্লিক করুন</a>
        </div>
      </div>
    </div>
  </div>
  @endif

  {{-- Section 3: Certificates --}}
  @if(count($certified_images) > 0)
  <div class="cert-section">
    <div class="container">
      <h2 class="section-title">ISO এবং BSTI ও BCSIR থেকে সার্টিফাইড</h2>
      {{-- Mobile: 1 image per slide --}}
      <div id="certCarouselMobile" class="carousel slide d-md-none" data-bs-ride="false">
        <div class="carousel-inner">
          @foreach($certified_images as $i => $img)
          <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
            <img src="{{ url('/') }}/public/{{ $img }}" class="d-block w-100 cert-img" alt="Certificate {{ $i+1 }}">
          </div>
          @endforeach
        </div>
        @if(count($certified_images) > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#certCarouselMobile" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" style="background-color:#064e03;"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#certCarouselMobile" data-bs-slide="next">
          <span class="carousel-control-next-icon" style="background-color:#064e03;"></span>
        </button>
        @endif
      </div>
      {{-- Desktop: 3 images per slide --}}
      <div id="certCarouselDesktop" class="carousel slide d-none d-md-block" data-bs-ride="false">
        <div class="carousel-inner">
          @foreach(array_chunk($certified_images, 3) as $chunk_i => $chunk)
          <div class="carousel-item {{ $chunk_i == 0 ? 'active' : '' }}">
            <div class="row g-2">
              @foreach($chunk as $photo)
              <div class="col-4">
                <img src="{{ url('/') }}/public/{{ $photo }}" class="d-block w-100 cert-img" alt="Certificate">
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
        @if(count($certified_images) > 3)
        <button class="carousel-control-prev" type="button" data-bs-target="#certCarouselDesktop" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" style="background-color:#064e03;"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#certCarouselDesktop" data-bs-slide="next">
          <span class="carousel-control-next-icon" style="background-color:#064e03;"></span>
        </button>
        @endif
      </div>
    </div>
  </div>
  @endif

  {{-- Section 4: Usage Instructions --}}
  @if($product->khawa_niyom)
  <div class="section-bg-other">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-5 instructions mb-4 mb-md-0">
          <div class="rule-title">খাওয়ার নিয়মাবলীঃ</div>
          @foreach(explode("\n", $product->khawa_niyom) as $rule)
          @if(trim($rule))
          <div class="rule-item"><i class="fas fa-check-circle me-2" style="color:#ffd700;"></i>{{ trim($rule) }}</div>
          @endif
          @endforeach
          <a href="#order-form" class="btn-order"><i class="fa-solid fa-cart-arrow-down"></i> অর্ডার করতে ক্লিক করুন</a>
        </div>
        <div class="col-12 col-md-5">
          <div class="product-card">
            <img src="{{ url('/') }}/public/uploads/{{ $product->folder }}/{{ $product->feasured_image }}" alt="{{ $product->product_title }}">
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
  </div>
  @endif

  {{-- Section 5: Customer Reviews --}}
  @if($product->allahr_opor_voro || $product->review_video_id || count($review_photos) > 0)
  <div class="section-bg">
    <div class="container">
      <h4 class="mb-2">এটি সম্পূর্ণ হোমমেড একটি প্রোডাক্ট তাই কোন পার্শ্ব প্রতিক্রিয়া নেই। <span
          style="color:#ffd700;">লিমিটেড স্টক, তাই দেরি না করে এখন-ই অর্ডার করুন।</span></h4>
      <a href="#order-form" class="btn-order"><i class="fa-solid fa-cart-arrow-down"></i> অর্ডার করতে ক্লিক করুন</a>

      @if($product->review_video_id || count($review_photos) > 0)
      <div class="stars mt-4">★★★ সম্মানিত কাস্টমারদের মতামত ★★★</div>
      <div class="row justify-content-center mt-3">
        @if($product->review_video_id)
        <div class="col-12 col-md-4 mb-3">
          <div class="media-box">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $product->review_video_id }}?autoplay=1&mute=0" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
        @endif
        @if(count($review_photos) > 0)
        <div class="col-12 {{ $product->review_video_id ? 'col-md-8' : 'col-md-12' }}">
          {{-- Mobile: 1 image per slide --}}
          <div id="reviewCarouselMobile" class="carousel slide d-md-none" data-bs-ride="false">
            <div class="carousel-inner">
              @foreach($review_photos as $i => $photo)
              <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                <img src="{{ url('/') }}/public/{{ $photo }}" class="d-block w-100 review-img" alt="Review">
              </div>
              @endforeach
            </div>
            @if(count($review_photos) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarouselMobile" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewCarouselMobile" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
            @endif
          </div>
          {{-- Desktop: 3 images per slide --}}
          <div id="reviewCarouselDesktop" class="carousel slide d-none d-md-block" data-bs-ride="false">
            <div class="carousel-inner">
              @foreach(array_chunk($review_photos, 3) as $chunk_i => $chunk)
              <div class="carousel-item {{ $chunk_i == 0 ? 'active' : '' }}">
                <div class="row g-2">
                  @foreach($chunk as $photo)
                  <div class="col-4">
                    <img src="{{ url('/') }}/public/{{ $photo }}" class="review-img" alt="Review">
                  </div>
                  @endforeach
                </div>
              </div>
              @endforeach
            </div>
            @if(count($review_photos) > 3)
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarouselDesktop" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewCarouselDesktop" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
            @endif
          </div>
        </div>
        @endif
      </div>
      @endif
      <a href="#order-form" class="btn-order mt-4"><i class="fa-solid fa-cart-arrow-down"></i> অর্ডার করতে ক্লিক করুন</a>
    </div>
  </div>
  @endif

  {{-- Section 6: Pricing --}}
  @if($product->best_selling || $product->product_price)
  <div class="section-bg-other">
    <div class="container">

      <div class="row">
        <div class="col-md-6 col-12">
          <div class="price-card">
            <div class="price-title">
              {{ $product->product_weight }}
              {{ $product->product_title }}
              এর অফার প্রাইস
              {{bn_number( $product->discount_price ?: $product->product_price )}}

              টাকা।

            </div>
          </div>
        </div>
        @foreach($products as $productRow)
        <div class="col-md-6 col-12">
          <div class="price-card">
            <div class="price-title">
              {{ $productRow->product_weight }}
              {{ $productRow->product_title }}
              এর অফার প্রাইস
              {{bn_number( $productRow->discount_price ?: $productRow->product_price )}}
              টাকা।
            </div>
          </div>
        </div>
        @endforeach


      </div>

      @if($product->allahr_opor_voro)
      <div class="row mt-4 align-items-center">
        <div class="col-12 col-md-6 message-text">{{ $product->allahr_opor_voro }}</div>
        <div class="col-12 col-md-6 delivery-offer">
          @if(($product->delivery_in_dhaka ?? 0) > 0 || ($product->delivery_out_dhaka ?? 0) > 0)
          ডেলিভারি চার্জ  ঢাকার ভেতরে: {{ $product->delivery_in_dhaka }} টাকা |ডেলিভারি চার্জ ঢাকার বাইরে: {{ $product->delivery_out_dhaka }} টাকা |
          @else
            এখন অর্ডার করলে<br>হোম ডেলিভারি চার্জ ফ্রি।
          @endif
        </div>
      </div>
      @endif
      <a href="#order-form" class="btn-order-now"><i class="fa-solid fa-cart-arrow-down"></i> অর্ডার করতে ক্লিক করুন</a>
    </div>
  </div>
  @endif

  {{-- Section 7: Order Form --}}
  <div class="order-form-section" id="order-form">
    <div class="container">
      <div class="header-box">অর্ডার করতে আপনার সঠিক তথ্য দিয়ে নিচের ফরমটি সম্পূর্ণ পূরণ করুন</div>
      <div class="order-card">
        <div class="mb-4">
          <h5 class="fw-bold mb-3">পরিমান সিলেক্ট করুন</h5>
          <div class="row g-3">
            @php
              $selectionProducts = collect([$product]);
              if (!empty($products)) {
                $selectionProducts = $selectionProducts->merge($products);
              }
            @endphp
            @foreach($selectionProducts as $index => $selProduct)
            <div class="col-12 col-md-6">
              <div class="custom-product-card border p-3 rounded {{ $index === 0 ? 'selected' : '' }}" id="card_product_{{ $index }}" data-index="{{ $index }}" onclick="selectProduct({{ $index }})">
                <img src="{{ url('/') }}/public/uploads/{{ $selProduct->folder }}/{{ $selProduct->feasured_image }}" alt="{{ $selProduct->product_title }}">
                 <input type="radio" name="product_select" id="product_{{ $index }}" value="{{ $selProduct->product_id }}"
                  data-price="{{ $selProduct->discount_price ?: $selProduct->product_price }}"
                  data-title="{{ $selProduct->product_title }}"
                  data-delivery-in="{{ $selProduct->delivery_in_dhaka ?? 0 }}"
                  data-delivery-out="{{ $selProduct->delivery_out_dhaka ?? 0 }}"
                  class="d-none"
                  {{ $index === 0 ? 'checked' : '' }}>
                <label for="product_{{ $index }}" class="ms-2">
                  <strong>{{ $selProduct->product_title }}</strong><br>
                  <small>@if(($selProduct->delivery_in_dhaka ?? 0) > 0 || ($selProduct->delivery_out_dhaka ?? 0) > 0)  @elseডেলিভারি চার্জ ফ্রি @endif</small><br>
                  <span class="text-success fw-bold">{{ $selProduct->discount_price ?: $selProduct->product_price }} ৳</span>
                </label>
              </div>
            </div>
            @endforeach
          </div>
        </div>
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
            <textarea id="customerAddress" class="input-field" rows="3" placeholder="ঠিকানা লিখুন থানা ও জেলা সহ"></textarea>
            <small class="text-danger d-none" id="addressError">ঠিকানা লিখুন</small>

            <div id="deliverySection">
              @if(($product->delivery_in_dhaka ?? 0) > 0 || ($product->delivery_out_dhaka ?? 0) > 0)
              <label class="mt-3 d-block">ডেলিভারি চার্জ *</label>
              <div class="d-flex gap-3 mt-2" id="courier-options-container">
                <div class="courier-option" id="opt_inside" onclick="selectCourier('inside')">
                  <input type="radio" name="courier_area" id="courier_inside" value="inside" checked>
                  <label for="courier_inside">
                     <span class="courier-charge">ঢাকার ভেতরে : <strong id="chargeInside">{{ $product->delivery_in_dhaka }} টাকা</strong></span>
                  </label>
                </div>
                <div class="courier-option" id="opt_outside" onclick="selectCourier('outside')">
                  <input type="radio" name="courier_area" id="courier_outside" value="outside">
                  <label for="courier_outside">
                     <span class="courier-charge">ঢাকার বাইরে : <strong id="chargeOutside">{{ $product->delivery_out_dhaka }} টাকা</strong></span>
                  </label>
                </div>
              </div>
              @else
              <label class="mt-3 d-block">ডেলিভারি চার্জ</label>
              <div class="mt-2 p-3 rounded" style="background:#e8f5e9; border:1px solid #c8e6c9;">
                <strong style="color:#064e03; font-size:16px;"><i class="fas fa-truck me-2"></i>ডেলিভারি চার্জ ফ্রি</strong>
              </div>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-5">
            <h5 class="mb-3">আপনার অর্ডার</h5>
            <div class="order-summary">
              <p id="summaryProduct">Product: {{ $product->product_title }} <b>{{ $product->discount_price ?: $product->product_price }} ৳</b></p>
              <p>ডেলিভারি চার্জ: <b id="summaryDelivery">@if(($product->delivery_in_dhaka ?? 0) > 0){{ $product->delivery_in_dhaka }} ৳ @elseফ্রি @endif</b></p>
              <hr>
              <p>মোট মূল্য: <b id="summaryTotal">{{ (($product->discount_price ?: $product->product_price) + ($product->delivery_in_dhaka ?? 0)) }} ৳</b></p>
              <p><small>ক্যাশ অন ডেলিভারি</small></p>
              <button class="submit-btn  " onclick="submitOrder()" type="button"><i class="fa-solid fa-cart-arrow-down me-2"></i>এখনই অর্ডার সম্পন্ন করুন</button>
            </div>
          </div>
        </div>
      </div>

      <form id="onePageOrderForm" action="{{ url('/onepage-order') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" id="form_product_id" name="product_id">
        <input type="hidden" id="form_product_price" name="product_price">
        <input type="hidden" id="form_customer_name" name="customer_name">
        <input type="hidden" id="form_customer_phone" name="customer_phone">
        <input type="hidden" id="form_customer_address" name="customer_address">
        <input type="hidden" id="form_courier_area" name="order_area">
        <input type="hidden" id="form_shipping_charge" name="shipping_charge">
        <input type="hidden" id="form_order_total" name="order_total">
      </form>
    </div>
  </div>

  {{-- Footer --}}
  <div class="footer-section">
    <a href="tel:{{ get_option('phone') ?? '+8801606700289' }}" style="border:2px solid #ffd700; display:inline-block; padding:10px 25px; border-radius:25px; margin-bottom:20px; color:white; text-decoration:none;">
      <i class="fas fa-phone-alt"></i> যেকোন প্রয়োজনে যোগাযোগ করুন : {{ get_option('phone') ?? '+880 1606-700289' }}
    </a>
    <div style="margin-top:15px;">
      <a href="javascript:void(0)" onclick="openModal('privacy')" style="color:white; margin:0 10px; text-decoration:none;">Privacy Policy</a> |
      <a href="javascript:void(0)" onclick="openModal('terms')" style="color:white; margin:0 10px; text-decoration:none;">Terms & conditions</a>
      <p style="margin-top:12px; color:#a5d6a7;">Copyright © {{ date('Y') }} {{ get_option('site_name') ?? 'Laam BD' }} | All Rights Reserved | Developed by <a href="https://sujon.tablighshop.com/dev/zakwanbd.com" target="_blank" style="color:#ffd700; text-decoration:none;">SIS Solution</a></p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      ['certCarouselMobile', 'certCarouselDesktop', 'reviewCarouselMobile', 'reviewCarouselDesktop'].forEach(function(id) {
        var el = document.getElementById(id);
        if (el) {
          new bootstrap.Carousel(el, {
            interval: false,
            touch: true,
            wrap: true
          });
        }
      });
    });

    let selectedProductPrice = @json((float)($product->discount_price ?: $product->product_price));
    let selectedProductTitle = @json($product->product_title);
    let deliveryInDhaka = @json((float)($product->delivery_in_dhaka ?? 0));
    let deliveryOutDhaka = @json((float)($product->delivery_out_dhaka ?? 0));
    let deliveryCharge = deliveryInDhaka;

    function fmtCharge(val) {
      return val > 0 ? val + ' টাকা' : 'ফ্রি';
    }

    function renderDeliverySection() {
      const section = document.getElementById('deliverySection');
      const hasCharge = deliveryInDhaka > 0 || deliveryOutDhaka > 0;
      if (hasCharge) {
        section.innerHTML =
          '<label class="mt-3 d-block">ডেলিভারি চার্জ *</label>' +
          '<div class="d-flex gap-3 mt-2" id="courier-options-container">' +
            '<div class="courier-option selected" id="opt_inside" onclick="selectCourier(\'inside\')">' +
              '<input type="radio" name="courier_area" id="courier_inside" value="inside" checked>' +
              '<label for="courier_inside">' +
                '<span class="courier-charge">ঢাকার ভেতরে : <strong id="chargeInside">' + fmtCharge(deliveryInDhaka) + '</strong></span>' +
              '</label>' +
            '</div>' +
            '<div class="courier-option" id="opt_outside" onclick="selectCourier(\'outside\')">' +
              '<input type="radio" name="courier_area" id="courier_outside" value="outside">' +
              '<label for="courier_outside">' +
                '<span class="courier-charge">ঢাকার বাইরে : <strong id="chargeOutside">' + fmtCharge(deliveryOutDhaka) + '</strong></span>' +
              '</label>' +
            '</div>' +
          '</div>';
        deliveryCharge = deliveryInDhaka > 0 ? deliveryInDhaka : deliveryOutDhaka;
      } else {
        section.innerHTML =
          '<label class="mt-3 d-block">ডেলিভারি চার্জ</label>' +
          '<div class="mt-2 p-3 rounded" style="background:#e8f5e9; border:1px solid #c8e6c9;">' +
            '<strong style="color:#064e03; font-size:16px;"><i class="fas fa-truck me-2"></i>ডেলিভারি চার্জ ফ্রি</strong>' +
          '</div>';
        deliveryCharge = 0;
      }
      document.getElementById('summaryDelivery').innerText = deliveryCharge > 0 ? deliveryCharge + ' ৳' : 'ফ্রি';
      document.getElementById('summaryTotal').innerText = (selectedProductPrice + deliveryCharge) + ' ৳';
    }

    function selectProduct(index) {
      const cards = document.querySelectorAll('.custom-product-card');
      cards.forEach(card => card.classList.toggle('selected', card.dataset.index === index.toString()));
      const input = document.getElementById('product_' + index);
      if (!input) return;
      input.checked = true;
      selectedProductPrice = Number(input.dataset.price) || 0;
      selectedProductTitle = input.dataset.title || selectedProductTitle;
      deliveryInDhaka = Number(input.dataset.deliveryIn) || 0;
      deliveryOutDhaka = Number(input.dataset.deliveryOut) || 0;
      renderDeliverySection();
      document.getElementById('summaryProduct').innerHTML = 'Product: ' + selectedProductTitle + ' <b>' + selectedProductPrice + ' ৳</b>';
    }

    // default selected
    document.addEventListener('DOMContentLoaded', function() {
      selectProduct(0);
    });

    function selectCourier(area) {
      deliveryCharge = area === 'inside' ? deliveryInDhaka : deliveryOutDhaka;
      document.getElementById('courier_' + area).checked = true;
      document.getElementById('opt_inside').classList.toggle('selected', area === 'inside');
      document.getElementById('opt_outside').classList.toggle('selected', area === 'outside');
      document.getElementById('summaryDelivery').innerText = deliveryCharge + ' ৳';
      document.getElementById('summaryTotal').innerText = (selectedProductPrice + deliveryCharge) + ' ৳';
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
        const checkedProduct = document.querySelector('input[name="product_select"]:checked');
        const checkedCourier = document.querySelector('input[name="courier_area"]:checked');
        
        document.getElementById('form_product_id').value = checkedProduct ? checkedProduct.value : '';
        document.getElementById('form_product_price').value = selectedProductPrice;
        document.getElementById('form_customer_name').value = name.value.trim();
        document.getElementById('form_customer_phone').value = phone.value.trim();
        document.getElementById('form_customer_address').value = address.value.trim();
        document.getElementById('form_courier_area').value = checkedCourier ? checkedCourier.value : 'inside';
        document.getElementById('form_shipping_charge').value = deliveryCharge;
        document.getElementById('form_order_total').value = selectedProductPrice + deliveryCharge;
        
        document.getElementById('onePageOrderForm').submit();
      }
    }
  </script>

  {{-- Privacy/Terms Modal --}}
  <div class="modal fade" id="infoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius:16px; border:2px solid #064e03;">
        <div class="modal-header" style="background:#064e03; color:#fff; border-radius:14px 14px 0 0;">
          <h5 class="modal-title" id="infoModalTitle">শর্তাবলী</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="infoModalBody" style="font-size:15px; line-height:1.8; max-height:60vh; overflow-y:auto;">
        </div>
        <div class="modal-footer" style="border-top:1px solid #e0e0e0;">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius:50px;">বন্ধ করুন</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Floating contact buttons --}}
  @php
    $phone = get_option('phone');
    $fb = get_option('facebook');
    $wa = $phone ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $phone) : '#';
    $msg = $fb ? 'https://m.me/' . basename(rtrim($fb, '/')) : '#';
  @endphp
  <div class="float-contact" id="floatContact">
    <div class="float-items" id="floatItems">
      <a href="{{ $wa }}" target="_blank" class="float-item whatsapp" title="WhatsApp">
        <i class="fab fa-whatsapp"></i><span>WhatsApp</span>
      </a>
      <a href="tel:{{ $phone }}" class="float-item call" title="কল করুন">
        <i class="fas fa-phone-alt"></i><span>কল</span>
      </a>
      @if($fb)
      <a href="{{ $msg }}" target="_blank" class="float-item messenger" title="Messenger">
        <i class="fab fa-facebook-messenger"></i><span>Messenger</span>
      </a>
      @endif
    </div>
    <button class="float-toggle" onclick="toggleFloat()">
      <i class="fas fa-headset"></i>
    </button>
  </div>

  {{-- Lightbox --}}
  <div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img id="lightboxImg" class="lightbox-img" alt="Full size">
  </div>

  <script>
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('review-img') || e.target.classList.contains('cert-img')) {
        document.getElementById('lightboxImg').src = e.target.src;
        document.getElementById('lightbox').classList.add('active');
      }
    });

    function closeLightbox(e) {
      if (!e || e.target === document.getElementById('lightbox') || e.target.classList.contains('lightbox-close')) {
        document.getElementById('lightbox').classList.remove('active');
      }
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') document.getElementById('lightbox').classList.remove('active');
    });

    function toggleFloat() {
      document.getElementById('floatContact').classList.toggle('active');
    }
    document.addEventListener('click', function(e) {
      const fc = document.getElementById('floatContact');
      if (fc.classList.contains('active') && !fc.contains(e.target)) {
        fc.classList.remove('active');
      }
    });

    function openModal(type) {
      const title = document.getElementById('infoModalTitle');
      const body = document.getElementById('infoModalBody');
      if (type === 'privacy') {
        title.innerText = 'Privacy Policy';
        body.innerHTML =
          '<h5 style="color:#064e03;">গোপনীয়তা নীতি</h5>' +
          '<p>আমরা আপনার ব্যক্তিগত তথ্যের গোপনীয়তাকে সম্মান করি এবং সুরক্ষিত রাখি।您的私人信息将严格保密。收集的数据仅用于订单处理和客户服务。</p>' +
          '<p>আমরা আপনার নাম, ফোন নম্বর এবং ঠিকানা শুধুমাত্র অর্ডার ডেলিভারির জন্য ব্যবহার করি।</p>' +
          '<p>আমরা কোনো তৃতীয় পক্ষের সাথে আপনার তথ্য শেয়ার করি না।</p>';
      } else {
        title.innerText = 'Terms & Conditions';
        body.innerHTML =
          '<h5 style="color:#064e03;">শর্তাবলী</h5>' +
          '<p>অর্ডার দেওয়ার মাধ্যমে আপনি নিম্নলিখিত শর্তাবলী মেনে নিচ্ছেন:</p>' +
          '<ul>' +
          '<li>পণ্য হাতে পেয়ে টাকা পরিশোধ করুন (Cash on Delivery)</li>' +
          '<li>ডেলিভারির সময় পণ্য চেক করে নিন</li>' +
          '<li>প্রোডাক্ট পরিবর্তনের জন্য ২৪ ঘন্টার মধ্যে যোগাযোগ করুন</li>' +
          '</ul>';
      }
      const modal = new bootstrap.Modal(document.getElementById('infoModal'));
      modal.show();
    }
  </script>
</body>

</html>