<?php
?>

<?php if($_SESSION['TIPO_USUARIO'] == 1){?>
    <div class="row mt-5">
        
        <div class="col-12 mt-5">
            <p class='h1'>Frequência</p>
            <div class="mt-5">
                <div class='row align-items-end'>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <button class='col-12 btn btn-primary btn-block fa-lg gradient-custom-2' onclick="registrar_horario_visu()" >Registrar horário</button>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <button class='col-12 btn btn-primary btn-block fa-lg gradient-custom-2'>Histórico de horários</button>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <label for="relacao_setor" class="form-label">Setor:</label>
                        <div id='relacao_setor' class="border border-success p-2">Clínica Cirúrgica</div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <label for="dia_atual" class="form-label">Dia:</label>
                        <div id='dia_atual' class="border border-success p-2">13/09/2024</div>
                    </div>
                </div>        
            </div>
            <div class="mt-5">
                <div class='row'>
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center bg-primary text-white">
                            <div class="card-header">Entrada</div>
                            <div class="card-body">
                                <p>16:15</p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">Intervalo</div>
                            <div class="card-body">
                                <p>Não registrado</p>
                            </div>
                        </div>
                    </div>          
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">Volta do Intervalo</div>
                            <div class="card-body">
                                <p>Não registrado</p>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">Saída</div>
                            <div class="card-body">
                               <p>Não registrado</p>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">2° Entrada</div>
                            <div class="card-body">
                                <p>Não registrado</p>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center">
                            <div class="card-header">2° Saída</div>
                            <div class="card-body">
                                <p>Não registrado</p>
                            </div>
                        </div>
                    </div>   
                </div>
                  
            </div>
        </div>

    </div>

    <div class="modal fade" id="registrarhorario_visu" tabindex="-1" aria-labelledby="registrarhorario_visu" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="registrarhorario_visu">Registrar Presença</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <span id='msgAlertErroCad' ></span> -->
                        <!-- Formulário de cadastro de estagiário.-->
                        <form id='cad-estagiario-form'>
                            <div class="mb-3">
                                <p>Tipo de Presença:</p>
                                <div class="">
                                    <div class="input-group">
                                        <div class="input-group-text" style="background-color: white; border: 0px !important;" >
                                            <input id="primeira_entrada" class="form-check-input mt-0" type="radio" name="tipo_entrada" value="entrada" aria-label="">
                                            <label for="primeira_entrada" class="">Primeira entrada:</label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-text" style="background-color: white; border: 0px !important;" >
                                            <input id="intervalo" class="form-check-input mt-0" type="radio" name="tipo_entrada" value="intervalo" aria-label="">
                                            <label for="intervalo" class="">Intervalo:</label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-text" style="background-color: white; border: 0px !important;" >
                                            <input id="volta_intervalo" class="form-check-input mt-0" type="radio" name="tipo_entrada" value="volta_intervalo" aria-label="">
                                            <label for="volta_intervalo" class="">Volta do Intervalo:</label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-text" style="background-color: white; border: 0px !important;" >
                                            <input id="primeira_saida" class="form-check-input mt-0" type="radio" name="tipo_entrada" value="saida" aria-label="">
                                            <label for="primeira_saida" class="">Primeira Saída</label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-text" style="background-color: white; border: 0px !important;" >
                                            <input id="segunda_entrada" class="form-check-input mt-0" type="radio" name="tipo_entrada" value="segunda_entrada" aria-label="">
                                            <label for="segunda_entrada" class="">Segunda Entrada:</label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-text" style="background-color: white; border: 0px !important;" >
                                            <input id="segunda_saida" class="form-check-input mt-0" type="radio" name="tipo_entrada" value="segunda_saida" aria-label="">
                                            <label for="segunda_saida" class="">Segunda Saída:</label>
                                        </div>
                                    </div>                           
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nome" class="col-form-label">Código:</label>
                                <input type="text" name="nome" class="form-control" id="codigo" placeholder='Código' value="66e85ee05e4e8">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="registrar_horario()">Ler QR Code</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Voltar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php } 
?>