<div class="modal-header">
    <h5 class="modal-title">Generar reporte</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<form action="">
    <div class="modal-body">
        <div class="form-group">
            <label>Reporte</label>
            <select id="type" class="form-control">
                <option value="0">Reporte de stock</option>
                <option value="1">Productos más vendidos</option>
                <option value="2">Reporte de vendedores</option>
            </select>
        </div>
        <div class="form-group">
            <label>Rango de fecha</label>
            <input type="text" class="form-control" name="daterange" value="{{ date('m/d/Y', strtotime(' - 30 days')) }} - {{ date('m/d/Y') }}" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal()" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="requestReport()">Generar</button>
    </div>
</form>

<script>
    var startDate = "{{ date('m/d/Y', strtotime(' - 30 days')) }}";
    var endDate = "{{ date('m/d/Y') }}";

    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            startDate = start.format('YYYY-MM-DD');
            endDate = end.format('YYYY-MM-DD');
        });
    });

    function requestReport() {
        axios.post("{{ route('generate.report') }}", {
            type: $('#type').val(),
            startDate: startDate,
            endDate: endDate
        }).then(
            res => {
                
            }
        );
    }
</script>
