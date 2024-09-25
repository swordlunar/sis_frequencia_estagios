<?php if ($_SESSION['TIPO_USUARIO'] == 1) { ?>
    <div class="row mt-5">
        <div class="col-12 mt-5">
            <p class='h1'>Frequência</p>
            <div class='row align-items-end mt-3 mt-md-5 '>
                <div class="col-lg-3 col-md-6 mt-2 mb-2 order-2 order-md-0"> <!-- order-last order-md-0 -->
                    <button class='col-12 btn btn-primary btn-block fa-lg gradient-custom-2 p-2' onclick="registrar_horario_modal()">Registrar horário</button>
                </div>
                <div class="col-lg-3 col-md-6 mt-2 mb-2 order-3 order-md-1">
                    <button class='col-12 btn btn-primary btn-block fa-lg gradient-custom-2 p-2' onclick="historico_de_horarios_modal()">Histórico de horários</button>
                </div>
                <div class="col-lg-3 col-md-6 mb-2 order-1 order-md-2">
                    <label for="relacao_setor" class="form-label">Setor:</label>
                    <div id='relacao_setor' class="border border-primary p-2"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-2 order-0 order-md-3">
                    <label for="dia_atual" class="form-label">Dia:</label>
                    <div id='dia_atual' class="border border-primary p-2"></div>
                </div>
            </div>
            <div class='row mt-md-5 mt-3'>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-5">
                    <div class="card text-center" id="card_visu_entrada_1">
                        <div class="card-header">Entrada</div>
                        <div class="card-body">
                            <p id="visu_entrada_1">Não registrado</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-5">
                    <div class="card text-center" id="card_visu_intervalo">
                        <div class="card-header">Intervalo</div>
                        <div class="card-body">
                            <p id="visu_intervalo">Não registrado</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-5">
                    <div class="card text-center" id="card_visu_volta_intervalo">
                        <div class="card-header">Volta do Intervalo</div>
                        <div class="card-body">
                            <p id="visu_volta_intervalo">Não registrado</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-5">
                    <div class="card text-center" id="card_visu_saida_1">
                        <div class="card-header">Saída</div>
                        <div class="card-body">
                            <p id="visu_saida_1">Não registrado</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-5">
                    <div class="card text-center" id="card_visu_entrada_2">
                        <div class="card-header">2° Entrada</div>
                        <div class="card-body">
                            <p id="visu_entrada_2">Não registrado</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-5">
                    <div class="card text-center" id="card_visu_saida_2">
                        <div class="card-header">2° Saída</div>
                        <div class="card-body">
                            <p id="visu_saida_2">Não registrado</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para registrar o horário -->
        <div class="modal fade" id="registrar_horario_modal" tabindex="-1" aria-labelledby="registrar_horario_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="titulo_registrar_horario_modal">Registrar Presença</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id='registro_horario_form'>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="tipo_presenca" class="col-form-label">Tipo de Presença:</label>
                                    <select id="tipo_presenca" class="form-select" name='tipo_presenca'>
                                        <option value='Primeira entrada'>Primeira entrada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nome" class="col-form-label">Código:</label>
                                <input type="text" name="nome" class="form-control" id="codigo" placeholder='Código' value="66e85ee05e4e8">
                            </div>
                            <div class="modal-footer">
                                <button id="botao_registro" type="button" class="btn btn-primary" onclick="registrar_horario()">Ler QR Code</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Voltar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal do calendário de horários -->
        <div class="modal fade" id="historico_de_horarios_modal" tabindex="-1" aria-labelledby="historico_de_horarios_modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="titulo_de_horarios_modal"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class='modal-body'>
                        <div class="d-flex justify-content-between">
                            <p id='setor_aluno'></p> <!-- setor do aluno -->
                            <p id='tempo_estagio'></p> <!-- horas estagiadas -->
                            
                        </div>
                        <div id='progresso_estagio' class="progress"> 
                                
                            </div>
                        <p id='periodo_letivo_h' class="h3 mt-3"></p>

                    </div>



                    <div class="container">
                        <div id="historico_de_horarios_calendar">

                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal do registro da frequência-->
        <div class="modal fade" id="frequencia_de_horarios_modal" tabindex="-1" aria-labelledby="frequencia_de_horarios_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="nome_aluno_f"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id='setor_aluno_f'></p>

                        <div class='d-flex justify-content-between'>
                            <div class="h5">Frequência: </div>
                            <div id='dia_atual_f'></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <span class="badge text-bg-success">Aprovado</span>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="" id="valor_entrada" disabled>
                                    <label for="floatingInput">Entrada</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="" id="valor_intervalo" disabled>
                                    <label for="floatingInput">Intervalo</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="" id="valor_volta_intervalo" disabled>
                                    <label for="floatingInput">Volta do intervalo</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="" id="valor_saida" disabled>
                                    <label for="floatingInput">Saída</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="" id="valor_entrada_2" disabled>
                                    <label for="floatingInput">Segunda entrada</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="" id="valor_saida_2" disabled>
                                    <label for="floatingInput">Segunda saida</label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="historico_de_horarios_modal()">Sair</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        ?>