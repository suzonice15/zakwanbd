
@extends('website.master')
@section('mainContent')
    <div class="container">
        <h2 style="text-align: center;background: #ddd;font-size: 21px;font-weight: bold;border: 2px solid #ddd;margin-bottom: 0px;padding: 9px;">Contest {{$status}} result</h2>
<div class="row">
    <div class="col-md-12 ">

        <div class="table-responsive">

            @if($status=='one')

                <table style="width:100%;border: 2px solid #8000ff;" class="table table-hover  table-bordered">
                    <thead style="background-color:#8000ff;color:white">
                    <tr>
                        <th class="text-center">Position</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Total Affiliate</th>
                        <th class="text-center">Active Affiliate</th>
                        <th class="text-center">Completed Sell</th>
                        <th class="text-center">Point</th>
                        <th class="text-center">Contest Prize Fund</th>
                    </tr>
                    </thead>
                    <tbody>




                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">4566</td>
                        <td class="text-center">MozAmmel R!doy</td>
                        <td class="text-center">51</td>


                        <td class="text-center">9</td>
                        <td class="text-center">105</td>
                        <td class="text-center">945</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">2</td>
                        <td class="text-center">4106</td>
                        <td class="text-center">Jannatul Fardous</td>
                        <td class="text-center">42</td>


                        <td class="text-center">10</td>
                        <td class="text-center">76</td>
                        <td class="text-center">760</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">3</td>
                        <td class="text-center">78</td>
                        <td class="text-center">Abu Tayab</td>
                        <td class="text-center">62</td>


                        <td class="text-center">3</td>
                        <td class="text-center">53</td>
                        <td class="text-center">159</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">4</td>
                        <td class="text-center">2</td>
                        <td class="text-center">Rawnak Jahan</td>
                        <td class="text-center">1038</td>


                        <td class="text-center">3</td>
                        <td class="text-center">42</td>
                        <td class="text-center">126</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">5</td>
                        <td class="text-center">2816</td>
                        <td class="text-center">MD Mahmudul Hasan</td>
                        <td class="text-center">39</td>


                        <td class="text-center">4</td>
                        <td class="text-center">28</td>
                        <td class="text-center">112</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">6</td>
                        <td class="text-center">5648</td>
                        <td class="text-center">Shahe Islam onim</td>
                        <td class="text-center">6</td>


                        <td class="text-center">3</td>
                        <td class="text-center">35</td>
                        <td class="text-center">105</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">7</td>
                        <td class="text-center">5539</td>
                        <td class="text-center">SHORIFUL ISLAM SHAKIB KHAN</td>
                        <td class="text-center">3</td>


                        <td class="text-center">2</td>
                        <td class="text-center">30</td>
                        <td class="text-center">60</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">8</td>
                        <td class="text-center">6298</td>
                        <td class="text-center">Zahirul islam</td>
                        <td class="text-center">2</td>


                        <td class="text-center">1</td>
                        <td class="text-center">12</td>
                        <td class="text-center">12</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">9</td>
                        <td class="text-center">5284</td>
                        <td class="text-center">Shainul islam sujon</td>
                        <td class="text-center">8</td>
                        <td class="text-center">1</td>
                        <td class="text-center">8</td>
                        <td class="text-center">8</td> <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">10</td>
                        <td class="text-center">2180</td>
                        <td class="text-center">Syeda Gul e Zannat</td>
                        <td class="text-center">2</td>


                        <td class="text-center">1</td>
                        <td class="text-center">5</td>
                        <td class="text-center">5</td>

                        <td class="text-center">0.00</td>

                    </tr>


                    </tbody>
                </table>

            @elseif($status=='two')

                <table style="width:100%;border: 2px solid #8000ff;" class="table table-hover  table-bordered">
                    <thead style="background-color:#8000ff;color:white">
                    <tr>
                        <th class="text-center">Position</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Total Affiliate</th>
                        <th class="text-center">Active Affiliate</th>
                        <th class="text-center">Completed Sell</th>
                        <th class="text-center">Point</th>
                        <th class="text-center">Contest Prize Fund</th>
                    </tr>
                    </thead>
                    <tbody>




                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">4106</td>
                        <td class="text-center">Jannatul Fardous</td>
                        <td class="text-center">50</td>


                        <td class="text-center">18</td>
                        <td class="text-center">87</td>
                        <td class="text-center">1566</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">2</td>
                        <td class="text-center">4566</td>
                        <td class="text-center">MozAmmel        R!doy</td>
                        <td class="text-center">79</td>


                        <td class="text-center">6</td>
                        <td class="text-center">94</td>
                        <td class="text-center">564</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">3</td>
                        <td class="text-center">74</td>
                        <td class="text-center">Habibullah mullah</td>
                        <td class="text-center">29</td>


                        <td class="text-center">5</td>
                        <td class="text-center">42</td>
                        <td class="text-center">210</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">4</td>
                        <td class="text-center">7689</td>
                        <td class="text-center">Nasim Islam</td>
                        <td class="text-center">39</td>


                        <td class="text-center">3</td>
                        <td class="text-center">56</td>
                        <td class="text-center">168</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">5</td>
                        <td class="text-center">5866</td>
                        <td class="text-center">Rocky Ahmed</td>
                        <td class="text-center">28</td>


                        <td class="text-center">4</td>
                        <td class="text-center">32</td>
                        <td class="text-center">128</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">6</td>
                        <td class="text-center">3</td>
                        <td class="text-center">Md Jobayer Mahmud</td>
                        <td class="text-center">26</td>


                        <td class="text-center">2</td>
                        <td class="text-center">49</td>
                        <td class="text-center">98</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">7</td>
                        <td class="text-center">5254</td>
                        <td class="text-center">Gaurav Chandra Roy</td>
                        <td class="text-center">12</td>


                        <td class="text-center">2</td>
                        <td class="text-center">26</td>
                        <td class="text-center">52</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">8</td>
                        <td class="text-center">9445</td>
                        <td class="text-center">Assad Ullah</td>
                        <td class="text-center">17</td>


                        <td class="text-center">3</td>
                        <td class="text-center">16</td>
                        <td class="text-center">48</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">9</td>
                        <td class="text-center">78</td>
                        <td class="text-center">Abu Tayab</td>
                        <td class="text-center">84</td>


                        <td class="text-center">3</td>
                        <td class="text-center">15</td>
                        <td class="text-center">45</td>

                        <td class="text-center">0.00</td>

                    </tr>





                    <tr>
                        <td class="text-center">10</td>
                        <td class="text-center">9421</td>
                        <td class="text-center">Hasib Shahriar</td>
                        <td class="text-center">7</td>


                        <td class="text-center">2</td>
                        <td class="text-center">11</td>
                        <td class="text-center">22</td>

                        <td class="text-center">0.00</td>

                    </tr>


                    </tbody>
                </table>





            @endif

        </div>

    </div>


</div>

    </div>
    @endsection