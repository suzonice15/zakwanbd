<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>অর্ডার সফল হয়েছে</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * { box-sizing: border-box; }
    body {
      font-family: 'SolaimanLipi', 'Noto Sans Bengali', sans-serif;
      background: #f0fff0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .thankyou-card {
      background: #fff;
      border-radius: 20px;
      border: 2px solid #064e03;
      box-shadow: 0 10px 40px rgba(6,78,3,0.12);
      max-width: 560px;
      width: 100%;
      overflow: hidden;
    }
    .thankyou-header {
      background: linear-gradient(135deg, #064e03, #00a844);
      color: #fff;
      padding: 40px 30px 30px;
      text-align: center;
    }
    .thankyou-header .icon {
      font-size: 60px;
      color: #ffd700;
      margin-bottom: 10px;
    }
    .thankyou-header h2 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .thankyou-header p {
      font-size: 15px;
      opacity: 0.9;
      margin: 0;
    }
    .thankyou-body {
      padding: 30px;
    }
    .order-info {
      background: #f8fff8;
      border: 1px solid #c8e6c9;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
    }
    .order-info .row-item {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px dashed #e0e0e0;
      font-size: 14px;
    }
    .order-info .row-item:last-child {
      border-bottom: none;
    }
    .order-info .label { color: #555; }
    .order-info .value { font-weight: 600; color: #064e03; }
    .product-list {
      margin-bottom: 20px;
    }
    .product-list h6 {
      color: #064e03;
      font-weight: bold;
      margin-bottom: 12px;
      font-size: 15px;
    }
    .product-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 0;
      border-bottom: 1px solid #f0f0f0;
    }
    .product-item:last-child { border-bottom: none; }
    .product-item img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 8px;
    }
    .product-item .pname { font-size: 14px; font-weight: 500; }
    .product-item .pprice { font-size: 13px; color: #064e03; font-weight: 600; }
    .btn-home {
      display: block;
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #064e03, #00a844);
      color: #fff;
      border: none;
      border-radius: 50px;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-home:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,200,83,0.4);
      color: #fff;
    }
    @media (max-width: 576px) {
      .thankyou-header { padding: 30px 20px 20px; }
      .thankyou-header .icon { font-size: 48px; }
      .thankyou-header h2 { font-size: 20px; }
      .thankyou-body { padding: 20px; }
    }
  </style>
</head>
<body>

  <div class="thankyou-card">
    <div class="thankyou-header">
      <div class="icon"><i class="fas fa-check-circle"></i></div>
      <h2>অর্ডার সফল হয়েছে!</h2>
      <p>আপনার অর্ডারটি গ্রহণ করা হয়েছে।</p>
    </div>

    <div class="thankyou-body">
      @if(isset($order))
      <div class="order-info">
        <div class="row-item">
          <span class="label">অর্ডার নং</span>
          <span class="value">#{{ $order->order_id }}</span>
        </div>
        <div class="row-item">
          <span class="label">নাম</span>
          <span class="value">{{ $order->customer_name }}</span>
        </div>
        <div class="row-item">
          <span class="label">ফোন</span>
          <span class="value">{{ $order->customer_phone }}</span>
        </div>
        <div class="row-item">
          <span class="label">ঠিকানা</span>
          <span class="value">{{ $order->customer_address }}</span>
        </div>
        <div class="row-item">
          <span class="label">ডেলিভারি চার্জ</span>
          <span class="value">{{ $order->shipping_charge > 0 ? $order->shipping_charge.' ৳' : 'ফ্রি' }}</span>
        </div>
        <div class="row-item">
          <span class="label">মোট মূল্য</span>
          <span class="value">{{ $order->advabced_price }} ৳</span>
        </div>
      </div>

      @if(count($order_items) > 0)
      <div class="product-list">
        <h6><i class="fas fa-box me-2"></i>পণ্যের বিবরণ</h6>
        @foreach($order_items as $item)
        @php $product = single_product_information($item->product_id); @endphp
        <div class="product-item">
          @if($product)
          <img src="{{ url('/') }}/public/uploads/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="">
          @endif
          <div>
            <div class="pname">{{ $product->product_title ?? 'Product' }}</div>
            <div class="pprice">{{ $item->price }} ৳ x {{ $item->qnt }}</div>
          </div>
        </div>
        @endforeach
      </div>
      @endif

      <p style="font-size:13px; color:#888; text-align:center; margin-bottom:15px;">
        <i class="fas fa-phone-alt me-1"></i> যেকোনো প্রয়োজনে কল করুন: {{ get_option('phone') }}
      </p>

      <a href="{{ url('/') }}" class="btn-home">
        <i class="fas fa-home me-2"></i>হোম পেজে ফিরে যান
      </a>
      @else
      <div class="text-center py-4">
        <i class="fas fa-exclamation-triangle" style="font-size:48px; color:#dc3545;"></i>
        <h5 style="color:#dc3545; margin-top:15px;">ভুল অর্ডার তথ্য!</h5>
        <a href="{{ url('/') }}" class="btn-home mt-3">হোম পেজে যান</a>
      </div>
      @endif
    </div>
  </div>

</body>
</html>