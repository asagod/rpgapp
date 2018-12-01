<!-- MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="editar-atributos-modal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="atributo" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Atributos</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group form-inline">
                                                <label for="forca" class="col-xs-4 col-md-4 col-form-label mb-1">Força:</label>
                                                <input type="number" class="form-control mb-1 col-xs-12 col-md-7" id="forcaedit" name="forca" value="<?php echo $row['forca'] ?>" min="1" max="100">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="destreza" class="col-xs-4 col-md-4 col-form-label mb-1">Destreza:</label>
                                                <input type="number" class="form-control mb-1 col-xs-12 col-md-7" id="destrezaedit" name="destreza" value="<?php echo $row['destreza'] ?>" min="1" max="100">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="vitalidade" class="col-xs-4 col-md-4 col-form-label mb-1">Vitalidade:</label>
                                                <input type="number" class="form-control mb-1 col-xs-12 col-md-7" id="vitalidadeedit" name="vitalidade" value="<?php echo $row['vitalidade'] ?>" min="1" max="100">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="inteligencia" class="col-xs-4 col-md-4 col-form-label mb-1">Inteligência:</label>
                                                <input type="number" class="form-control mb-1 col-xs-12 col-md-7" id="inteligenciaedit" name="inteligencia" value="<?php echo $row['inteligencia'] ?>" min="1" max="100">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="sabedoria" class="col-xs-4 col-md-4 col-form-label mb-1">Sabedoria:</label>
                                                <input type="number" class="form-control mb-1 col-xs-12 col-md-7" id="sabedoriaedit" name="sabedoria" value="<?php echo $row['sabedoria'] ?>" min="1" max="100">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="determinacao" class="col-xs-4 col-md-4 col-form-label mb-1">Determinação:</label>
                                                <input type="number" class="form-control mb-1 col-xs-12 col-md-7" id="determinacaoedit" name="determinacao" value="<?php echo $row['determinacao'] ?>" min="1" max="100">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="personalidade" class="col-xs-4 col-md-4 col-form-label mb-1">Personalidade:</label>
                                                <input type="number" class="form-control mb-1 col-xs-12 col-md-7" id="personalidadeedit" name="personalidade" value="<?php echo $row['personalidade'] ?>" min="1" max="100">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="labia" class="col-xs-4 col-md-4 col-form-label mb-1">Lábia:</label>
                                                <input type="number" class="form-control mb-1 col-xs-12 col-md-7" id="labiaedit" name="labia" value="<?php echo $row['labia'] ?>" min="1" max="100">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="compostura" class="col-xs-4 col-md-4 col-form-label mb-1">Compostura:</label>
                                                <input type="number" class="form-control mb-1 col-xs-12 col-md-7" id="composturaedit" name="compostura" value="<?php echo $row['compostura'] ?>" min="1" max="100">
                                            </div>
                                            <input type="hidden" class="form-control" id="charid" name="charid" value="<?php echo $charid ?>">
                                            <input type="hidden" class="form-control" id="userId" name="userId" value="<?php echo $userId ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <!-- MODAL -->