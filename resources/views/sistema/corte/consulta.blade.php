@extends('adminlte.layout')

@section('title', 'Consulta Tallas')


@section('content')
<div class="container bg-light">
    <div class="row corteSearch border mt-3">
        <div class="col-12 mt-5">
            <h4>Numero de corte(*):</h4>
            <select name="tags[]" id="cortesSearch" class="form-control select2">
            </select>
        </div>
        <div class="col-12 mt-4 mr-3 d-flex justify-content-begin">
            <button class="btn btn-outline-success " id="btn-buscar">Buscar <i class="fas fa-search"></i></button>
        </div>
    </div>
</div>

<h4 class="text-center mt-3">Tallas</h4>
<hr>
<div class="row mt-3 pb-4">
    <div class="col-lg-1 col-xs-">
        <label for="" class="ml-4">A</label>
        <input type="text" name="" id="a" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">B</label>
        <input type="text" name="" id="b" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">C</label>
        <input type="text" name="" id="c" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">D</label>
        <input type="text" name="" id="d" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">E</label>
        <input type="text" name="" id="e" class="form-control text-center">
    </div>
    <div class="col-md-1">
        <label for="" class="ml-4">F</label>
        <input type="text" name="" id="f" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">G</label>
        <input type="text" name="" id="g" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">H</label>
        <input type="text" name="" id="h" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">I</label>
        <input type="text" name="" id="i" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">J</label>
        <input type="text" name="" id="j" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">K</label>
        <input type="text" name="" id="k" class="form-control text-center">
    </div>
    <div class="col-lg-1">
        <label for="" class="ml-4">L</label>
        <input type="text" name="" id="l" class="form-control text-center">
    </div>
</div>
<div class="row pb-4">
    <div class="col-4">
        <label for="">Total:</label>
        <input type="text" name="" id="total" class="form-control text-center">
    </div>
    <div class="col-4 mt-4 pt-2">
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
            aria-controls="collapseExample">
            Verificar tallas
        </a>
    </div>
</div>

<div class="collapse" id="collapseExample">
    {{-- <div class="card card-body"> --}}
        <div class="row mt-3 corteSearch border">
            <table class="table  table-bordered table-responsive mt-3">
                <thead>
                    <tr class="bg-secondary">
                        <th>Tipo producto</th>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>E</th>
                        <th>F</th>
                        <th>G</th>
                        <th>H</th>
                        <th>I</th>
                        <th>J</th>
                        <th>K</th>
                        <th>L</th>
                    </tr>
                </thead>
                <tr>
                    <th class="bg-light">Niño</th>
                    <th>2</th>
                    <th>4</th>
                    <th>6</th>
                    <th>8</th>
                    <th>10</th>
                    <th>12</th>
                    <th>14</th>
                    <th>16</th>
                </tr>
                <tr>
                    <th class="bg-light">Niña</th>
                    <th>2</th>
                    <th>4</th>
                    <th>6</th>
                    <th>8</th>
                    <th>10</th>
                    <th>12</th>
                    <th>14</th>
                    <th>16</th>
                </tr>
                <tr>
                    <th class="bg-light">Dama TA</th>
                    <th>0/0</th>
                    <th>1/2</th>
                    <th>3/4</th>
                    <th>5/6</th>
                    <th>7/8</th>
                    <th>9/10</th>
                    <th>11/12</th>
                    <th>13/14</th>
                    <th>15/16</th>
                    <th>17/18</th>
                    <th>19/20</th>
                    <th>21/22</th>
                </tr>
                <tr>
                    <th class="bg-light">Dama plus</th>
                    <th>12W</th>
                    <th>14W</th>
                    <th>16W</th>
                    <th>18W</th>
                    <th>20W</th>
                    <th>22W</th>
                    <th>24W</th>
                    <th>26W</th>
                </tr>
                <tr>
                    <th class="bg-light">Caballero Skinny</th>
                    <th>28</th>
                    <th>29</th>
                    <th>30</th>
                    <th>32</th>
                    <th>34</th>
                    <th>36</th>
                    <th>38</th>
                    <th>40</th>
                    <th>42</th>
                    <th>44</th>
                </tr>
            </table>
        </div>
    {{-- </div> --}}
</div>






@include('adminlte/scripts')
<script src="{{asset('js/corte.js')}}"></script>





@endsection