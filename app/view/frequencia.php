<?php if($_SESSION['TIPO_USUARIO'] == 1){?>
    <div class="row mt-5">
        
        <div class="col-12 mt-5">
            <p class='h1'>Frequência</p>
            <div class="mt-5">
                <div class='row align-items-end'>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <button class='col-12 btn btn-primary btn-block fa-lg gradient-custom-2' onclick="registrar_horario_modal()" >Registrar horário</button>
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
                        <div class="card text-center" id = "card_visu_entrada_1">
                            <div class="card-header">Entrada</div>
                            <div class="card-body">
                                <p id="visu_entrada_1" >Não registrado</p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center" id = "card_visu_intervalo">
                            <div class="card-header">Intervalo</div>
                            <div class="card-body">
                                <p id="visu_intervalo" >Não registrado</p>
                            </div>
                        </div>
                    </div>          
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center" id = "card_visu_volta_intervalo">
                            <div class="card-header">Volta do Intervalo</div>
                            <div class="card-body">
                                <p id="visu_volta_intervalo" >Não registrado</p>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center" id = "card_visu_saida_1">
                            <div class="card-header">Saída</div>
                            <div class="card-body">
                               <p id="visu_saida_1" >Não registrado</p>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center" id = "card_visu_entrada_2">
                            <div class="card-header">2° Entrada</div>
                            <div class="card-body">
                                <p id="visu_entrada_2" >Não registrado</p>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card text-center" id = "card_visu_saida_2">
                            <div class="card-header">2° Saída</div>
                            <div class="card-body">
                                <p id="visu_saida_2" >Não registrado</p>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registrar_horario_modal" tabindex="-1" aria-labelledby="registrar_horario_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="registrar_horario_modal">Registrar Presença</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <span id='msgAlertErroCad' ></span> -->
                        <!-- Formulário de cadastro de estagiário.-->
                        <form id='cad-estagiario-form'>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="tipo_presença" class="col-form-label">Tipo de Presença:</label>
                                    <select id="tipo_presença" class="form-select" name='tipo_presença'>
                                        
                                        <option value='Primeira entrada'>Primeira entrada</option>
                                        
                                        
                                        <option value="Intervalo">Intervalo</option>
                                        <option value="Volta do intervalo">Volta do intervalo</option>
                                        <option value="Saída">Saída</option>
                                        <option value="Segunda Entrada">Segunda Entrada</option>
                                        <option value="Segunda Saída">Segunda Saída</option>
                                        
                                    </select>
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