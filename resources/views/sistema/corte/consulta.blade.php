@extends('adminlte.layout')

@section('title', 'Consulta Tallas')
    

@section('content')
<div class="row">
        <table class="table  table-bordered table-responsive">
            <thead>
                <tr>
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
                <th>Niño</th>
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
                <th>Niña</th>
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
                <th>Dama TA</th>
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
                <th>Dama plus</th>
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
                <th>Caballero Skinny</th>
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
    



@include('adminlte/scripts')
<script src="{{asset('js/corte.js')}}"></script>





@endsection