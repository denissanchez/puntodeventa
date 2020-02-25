<div class="modal-header">
    <h5 class="modal-title">Registrar nuevo producto</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>Código</label>
        <input type="text" class="form-control" name="origin_code">
    </div>
    <div class="form-row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Categoría</label>
                <select name="category" class="form-control select2Product" data-data="" required>
                    <option value="-" selected>-</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Marca</label>
                <select name="brand" class="form-control select2Product" data-data="" required>
                    <option value="-" selected>-</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-12 col-md-7">
            <div class="form-group">
                <label>Laboratorio</label>
                <select name="laboratory" id="" class="form-control select2Product" data-data="" required>
                    <option value="-" selected>-</option>
                    @foreach($laboratories as $laboratory)
                        <option value="{{ $laboratory->id }}">{{ $laboratory->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-5">
            <div class="form-group">
                <label>U. medida</label>
                <select name="measure_unit" class="form-control select2Product" data-data="" data-tags="true" required>
                    <option value="-" selected>-</option>
                    @foreach($measure_units as $measure_unit)
                        <option value="{{ $measure_unit->id }}">{{ $measure_unit->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control to-upper" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Descripción</label>
        <textarea name="description" rows="3" class="form-control to-upper" required></textarea>
    </div>
    <div class="form-group">
        <label>Composición</label>
        <textarea name="composition" rows="3" class="form-control to-upper" required></textarea>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
