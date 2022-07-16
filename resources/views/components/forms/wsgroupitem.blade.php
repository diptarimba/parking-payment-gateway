<div class="input-group mb-2" data-line-unique="{{ $eachIdent }}">
    <span class="input-group-text">Min, Max, Price</span>
    <input type="number" class="wsGroupItem {{$identify ? 'wsGroupItem'.$identify : ''}} form-control minvalue" placeholder="Min" value="{{$min}}"
        name="{{$identify ? $identify.'[wholesaler]' : 'wholesaler'}}[{{$varian}}][minimum]" required="">
    <input type="number" class="wsGroupItem {{$identify ? 'wsGroupItem'.$identify : ''}} form-control maxvalue" placeholder="Max" value="{{$max}}"
        name="{{$identify ? $identify.'[wholesaler]' : 'wholesaler'}}[{{$varian}}][maximum]" required="">
    <input type="number" class="wsGroupItem {{$identify ? 'wsGroupItem'.$identify : ''}} form-control" required="" placeholder="Price" value="{{$price}}"
        name="{{$identify ? $identify.'[wholesaler]' : 'wholesaler'}}[{{$varian}}][price]" required="">
    <input type="hidden" class="wsGroupItem {{$identify ? 'wsGroupItem'.$identify : ''}} varianId{{$identify}} form-control" required="" placeholder="Price"
        name="{{$identify ? $identify.'[wholesaler]' : 'wholesaler'}}[{{$varian}}][varian_id]" required="" value="{{$varian}}">
    <input class="form-control {{$identify ? 'wsGroupItem'.$identify : ''}} btn btn-danger deletePrice fa-solid fa-xmark" style="max-width: 10%" data-line-unique="{{ $eachIdent }}" id="{{$idWholeSaler}}">
</div>
