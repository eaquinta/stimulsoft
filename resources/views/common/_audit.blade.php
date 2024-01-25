<div class="modal fade" id="modal-{{ $entidad }}-audits" data-bs-backdrop="static" aria-labelledby="modal-createLabel" aria-hidden="true">
    <!--bounceIn-->
    <div class="modal-dialog modal-xl animated pulse">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-secondary" id="modal--{{ $entidad }}--audits-label">Auditoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <div class="table-responsive">
                    <table id="table-audits" class="table table-sm">
                        <thead>
                            <tr class="accordion-toggle collapsed" id="accordion1" data-mdb-toggle="collapse" data-mdb-parent="#accordion1" href="#collapseOne"aria-controls="collapseOne">
                                <th></th>
                                <th>Ususario</th>
                                <th>Evento</th>
                                <th>Dirección IP</th>
                                <th>Marca de Tiempo</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary rounded-0" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
