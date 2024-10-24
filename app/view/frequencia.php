<?php if ($_SESSION['TIPO_USUARIO'] == 1) { ?> <!-- view do aluno -->
    <div class="row mt-5">
        <div class="col-12 mt-5">
            <div class="h1"><span>Frequência</span></div>
            <div class=""><span><?php echo $_SESSION['NOME']; ?></span></div>
        </div>

        <div class='row align-items-end mt-3 '>
            <div class="col-lg-3 col-md-6 mt-2 mb-2 order-2 order-md-0">
                <button id='botao_registro' class='col-12 btn btn-primary btn-block fa-lg gradient-custom-2 p-2' onclick="registrar_horario_modal()">Registrar horário</button>
            </div>
            <div class="col-lg-3 col-md-6 mt-2 mb-2 order-3 order-md-1">
                <button class='col-12 btn btn-primary btn-block fa-lg gradient-custom-2 p-2' onclick="historico_de_horarios_modal()">Histórico de horários</button>
            </div>
            <div class="col-lg-3 col-md-6 mb-2 order-1 order-md-2">
                <label for="relacao_setor" class="form-label">Setor:</label>
                <div id='relacao_setor' class="border border-primary p-2">Não definido.</div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2 order-0 order-md-3">
                <label for="dia_atual" class="form-label">Dia:</label>
                <div id='dia_atual' class="border border-primary p-2">Não definido.</div>
            </div>
        </div>

        <div class='row mt-md-5 mt-3'> <!-- Cards dos registros  -->
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
                        <div class="modal-footer">
                            <button id="botao_registro" type="button" class="btn btn-primary" onclick="scanear_qrcode_modal()">Ler QR Code</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Voltar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para scanear o QRCODE -->
    <div class="modal fade" id="modal_qrcode" tabindex="-1" aria-labelledby="modal_qrcode" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="titulo_modal_qrcode">Ler QR Code</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="leitor_qrcode" width="600px">
                        <!-- div que terá o leitor de qrcode -->
                    </div>
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
                    <p id='setor_aluno_f'></p> <!-- setor do aluno -->

                    <div class='d-flex justify-content-between'>
                        <div class="h5">Frequência: </div>
                        <div id='dia_atual_f'></div> <!-- data do dia da frequência -->
                    </div>

                    <div class="row mb-3">
                        <div class="col-12" id='status_badge'></div> <!-- status da frequência -->
                    </div>

                    <div class='row'> <!-- inputs das entradas e saídas -->
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
    </div>
<?php } else if (($_SESSION['TIPO_USUARIO'] == 2)) { ?> <!-- view do supervisor -->
    <div class="row mt-5">
        <div class="col-12 mt-5">
            <div class="h1 mb-3"><span>Frequência</span></div>
            <div class="row d-flex mb-3">
                <div id='relacao_setor' class="col-md-2 h6"><span>Setor</span></div>
                <div class="col-md-2 h6"><span><?php echo $_SESSION['NOME']; ?></span></div>
            </div>
            <div class="table-responsive">
                <table id="listar_estagiarios" class="table table-striped table-hover display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Matrícula</th>
                            <th>E-mail</th>
                            <th>Turma</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal das informações do aluno -->
    <div class="modal fade" id="info_aluno" tabindex="-1" aria-labelledby="info_aluno" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="titulo_info_aluno">Nome do aluno</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class='modal-body'>
                    <p class="h5">Informações do aluno</p>
                    <div class="row d-block">
                        <div class="col mb-2">
                            <label for="floatingInput">Setor:</label>
                            <input type="text" class="form-control" value="Não registrado" id="valor_setor" disabled>
                        </div>
                        <div class="col mb-2">
                            <label for="floatingInput">E-mail:</label>
                            <input type="text" class="form-control" value="Não registrado" id="valor_email" disabled>
                        </div>
                        <div class="col mb-2">
                            <label for="floatingInput">Matrícula:</label>
                            <input type="text" class="form-control" value="Não registrado" id="valor_matricula" disabled>
                        </div>
                        <div class="col mb-2">
                            <label for="floatingInput">Telefone:</label>
                            <input type="text" class="form-control" value="Não registrado" id="valor_telefone" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal dos registros de horários em lote -->
    <div class="modal fade" id="registros_em_lote_modal" tabindex="-1" aria-labelledby="registros_em_lote_modal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="titulo_de_registros_em_lote_modal">Nome do aluno</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class='modal-body'>
                    <div class="d-flex justify-content-between">
                        <p id='setor_aluno_l' class="h5">Setor do aluno</p>
                        <p id='periodo_letivo_l' class="h5">Frequência periodo letivo</p>
                    </div>

                    <div class="row mt-2 justify-content-center align-items-center text-center">
                        <div class="col-6">
                            <div class="row">
                                <label for="mes_pendentes" class="h4 form-label">Selecione o mês:</label>
                            </div>
                            <div class="row justify-content-center align-items-center text-center">
                                <div class="col-5">
                                    <select id="mes_pendentes" class="form-select" name='mes_pendentes'>
                                        <option selected value=''>Mês</option>
                                        <option value='janeiro'>Janeiro</option>
                                        <option value='fevereiro'>Fevereiro</option>
                                        <option value='março'>Março</option>
                                        <option value='abril'>Abril</option>
                                        <option value='maio'>Maio</option>
                                        <option value='junho'>Junho</option>
                                        <option value='julho'>Julho</option>
                                        <option value='agosto'>Agosto</option>
                                        <option value='setembro'>Setembro</option>
                                        <option value='outubro'>Outubro</option>
                                        <option value='novembro'>Novembro</option>
                                        <option value='dezembro'>Dezembro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2 row justify-content-center align-items-center text-center">
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary" onclick="filtrar_por_mes()">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="table-responsive">
                            <table id='registros_em_lote' class="table justify-content-center text-center table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Dia</th>
                                        <th>Entrada</th>
                                        <th>Intervalo</th>
                                        <th>Volta do Intervalo</th>
                                        <th>Saída</th>
                                        <th>Segunda Entrada</th>
                                        <th>Segunda Saída</th>
                                        <th>Status</th>
                                        <th><input id="checkAll" name="all" type="checkbox"></th>
                                    </tr>
                                </thead>
                                <tbody id='corpo_registros_em_lote'>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='botao_aprovar_em_lote' onclick="aprovar_frequencia_em_lote()">Aprovar</button>
                    <button type="button" class="btn btn-primary" id="botao_sair_frequencia_2" data-bs-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<!-- Modal do calendário de horários -->
<div class="modal fade" id="historico_de_horarios_modal" tabindex="-1" aria-labelledby="historico_de_horarios_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="titulo_de_horarios_modal">Nome do aluno</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class='modal-body'>
                <div class="d-flex justify-content-between">
                    <p id='setor_aluno'>Setor do aluno</p>
                    <p id='tempo_estagio'>Horas estagiadas</p>
                </div>

                <div id='progresso_estagio' class="progress"></div> <!-- barra de progresso do estágio -->
                <p id='periodo_letivo_h' class="h3 mt-3">Período letivo do aluno</p>
            </div>

            <div class="container">
                <div id="historico_de_horarios_calendar">
                    <!-- div que vai conter o calendário da biblioteca fullcalendar -->
                </div>
            </div>

            <div class="modal-footer">
                <?php if (($_SESSION['TIPO_USUARIO'] != 1)) { ?>
                    <button id="botao_aprovar_em_lote_modal" type="button" class="btn btn-primary" value='' onclick="aprovar_em_lote_modal(this.value)">Aprovar registros em lote</button>
                <?php } ?>
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
                <p id='setor_aluno_f'></p> <!-- setor do aluno -->

                <div class='d-flex justify-content-between'>
                    <div class="h5">Frequência: </div>
                    <div id='dia_atual_f'></div> <!-- data do dia da frequência -->
                </div>

                <div class="row mb-3">
                    <div class="col-12" id='status_badge'></div> <!-- status da frequência -->
                </div>

                <div class='row'> <!-- inputs das entradas e saídas -->
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" value="" id="valor_entrada">
                            <label for="floatingInput">Entrada</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" value="" id="valor_intervalo">
                            <label for="floatingInput">Intervalo</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" value="" id="valor_volta_intervalo">
                            <label for="floatingInput">Volta do intervalo</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" value="" id="valor_saida">
                            <label for="floatingInput">Saída</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" value="" id="valor_entrada_2">
                            <label for="floatingInput">Segunda entrada</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-3">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" value="" id="valor_saida_2">
                            <label for="floatingInput">Segunda saida</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="" id="observacao_frequencia">
                            <label for="floatingInput">Observações</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='botao_aprovar_frequencia' onclick="aprovar_frequencia(this.value)">Aprovar frequência</button>
                    <button type="button" class="btn btn-primary" id='botao_salvar_frequencia' value='' onclick="salvar_alteracoes(this.value)">Salvar</button>
                    <button type="button" class="btn btn-primary" id='botao_sair_frequencia' data-bs-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>
</div>