(function () {
    function limpaForm(clForm) {
        const inputs = clForm.querySelectorAll('input');
        inputs.forEach(input => input.value = '');
        const select = clForm.querySelector('select');
        if (typeof select !== undefined && select) {
            select.value = '';
        }
    }

    function limpaMensagens() {
        const clFormMessagesHtml = document.getElementById('cl-form-messages');
        if (typeof clFormMessagesHtml !== undefined && clFormMessagesHtml) {
            clFormMessagesHtml.innerHTML = '';
        }
    }

    function exibeMensagens(msg, tipo) {
        const clFormMessagesHtml = document.getElementById('cl-form-messages');
        if (typeof clFormMessagesHtml === undefined || !clFormMessagesHtml) {
            switch (tipo) {
                case 'error':
                    console.error('Erro', msg);
                    break;

                case 'warning':
                    console.warn('Aviso', msg);
                    break;

                default:
                    console.log('Sucesso', msg);
                    break;
            }
        } else {
            let classe;
            switch (tipo) {
                case 'error':
                    classe = 'cl-form-messages-errors';
                    break;

                case 'warning':
                    classe = 'cl-form-messages-warning';
                    break;

                default:
                    classe = 'cl-form-messages-success';
                    break;
            }
            const ul = document.createElement('ul');
            ul.classList.add(classe);

            const li = document.createElement('li');
            li.innerText = msg;

            ul.append(li);
            clFormMessagesHtml.append(ul);
        }
    }

    function calculaLeads() {
        const clForm = document.getElementById('cl-form');
        if (typeof clForm === undefined || !clForm) {
            return;
        }

        const clResultados = document.getElementById('cl-resultados');
        if (typeof clResultados === undefined || !clResultados) {
            return;
        }

        const button = clForm.querySelector('button');
        if (typeof button === undefined || !button) {
            return;
        }

        console.log('calculaLeads');
        console.log('button', button.disabled);

        clForm.addEventListener('submit', e => {
            e.preventDefault();

            if (button.disabled) {
                return;
            }
            button.disabled = true;
            button.innerText = 'Calculando...';

            limpaMensagens();

            const clResultados = document.getElementById('cl-resultados');
            clResultados.style.display = 'none';

            console.log('submit');

            const ajaxUrl = ajax_object.ajax_url;
            const data = new FormData(clForm);
            data.append('action', 'cl_calcula_leads');

            fetch(ajaxUrl, {
                method: 'POST',
                body: data
            })
                .then((response) => response.json())
                .then((response) => {
                    if (!response) {
                        return exibeMensagens('A calculadora não retornou nenhum resultado.', 'warning');
                    }
                    if (!response.success) {
                        return exibeMensagens(response.data.msg, 'error');
                    }
                    // limpaForm(clForm);

                    const visitantes_leads_pct = response.data.visitantes_leads_pct;
                    const visitantes_leads_pct_html = document.getElementById('visitantes_leads');
                    if (typeof visitantes_leads_pct_html !== undefined && visitantes_leads_pct_html) {
                        visitantes_leads_pct_html.innerText = visitantes_leads_pct + '%';
                    }

                    const leads_oportunidades_pct = response.data.leads_oportunidades_pct;
                    const leads_oportunidades_pct_html = document.getElementById('leads_oportunidades');
                    if (typeof leads_oportunidades_pct_html !== undefined && leads_oportunidades_pct_html) {
                        leads_oportunidades_pct_html.innerText = leads_oportunidades_pct + '%';
                    }

                    const oportunidades_vendas_pct = response.data.oportunidades_vendas_pct;
                    const oportunidades_vendas_pct_html = document.getElementById('oportunidades_vendas');
                    if (typeof oportunidades_vendas_pct_html !== undefined && oportunidades_vendas_pct_html) {
                        oportunidades_vendas_pct_html.innerText = oportunidades_vendas_pct + '%';
                    }

                    const vendas = response.data.vendas;
                    const vendas_html = document.getElementById('resultado-vendas');
                    if (typeof vendas_html !== undefined && vendas_html) {
                        vendas_html.innerText = vendas;
                    }

                    const oportunidades_vendas = response.data.oportunidades_vendas;
                    const oportunidades_vendas_html = document.getElementById('resultado-oportunidades');
                    if (typeof oportunidades_vendas_html !== undefined && oportunidades_vendas_html) {
                        oportunidades_vendas_html.innerText = oportunidades_vendas;
                    }

                    const leads_oportunidades = response.data.leads_oportunidades;
                    const leads_oportunidades_html = document.getElementById('resultado-assinantes-e-leads');
                    if (typeof leads_oportunidades_html !== undefined && leads_oportunidades_html) {
                        leads_oportunidades_html.innerText = leads_oportunidades;
                    }

                    const visitantes_leads = response.data.visitantes_leads;
                    const visitantes_leads_html = document.getElementById('resultado-visitantes-unicos');
                    if (typeof visitantes_leads_html !== undefined && visitantes_leads_html) {
                        visitantes_leads_html.innerText = visitantes_leads;
                    }

                    const vendas_desejadas_html = document.getElementById('resultado-vendas-desejadas');
                    if (typeof vendas_desejadas_html !== undefined && vendas_desejadas_html) {
                        vendas_desejadas_html.innerText = vendas;
                    }

                    const taxa_conversao = response.data.taxa_conversao;
                    const taxa_conversao_html = document.getElementById('resultado-taxas-conversao');
                    if (typeof taxa_conversao_html !== undefined && taxa_conversao_html) {
                        taxa_conversao_html.innerText = taxa_conversao + '%';
                    }

                    // const vendedores_necessarios = response.data.vendedores_necessarios;
                    // const vendedores_necessarios_html = document.getElementById('resultado-vendedores-necessarios');
                    // if (typeof vendedores_necessarios_html !== undefined && vendedores_necessarios_html) {
                    //     vendedores_necessarios_html.innerText = vendedores_necessarios;
                    // }

                    // const leads_atendidos = response.data.leads_atendidos;
                    // const leads_atendidos_html = document.getElementById('resultado-leads-atendidos');
                    // if (typeof leads_atendidos_html !== undefined && leads_atendidos_html) {
                    //     leads_atendidos_html.innerText = leads_atendidos;
                    // }

                    // const vendas_realizadas = response.data.vendas_realizadas;
                    // const vendas_realizadas_html = document.getElementById('resultado-vendas-realizadas');
                    // if (typeof vendas_realizadas_html !== undefined && vendas_realizadas_html) {
                    //     vendas_realizadas_html.innerText = vendas_realizadas;
                    // }

                    exibeMensagens('Cálculo de leads finalizado! Veja o resultado abaixo.');

                    clResultados.style.display = 'block';
                    clResultados.scrollIntoView(false);

                })
                .catch((error) => {
                    exibeMensagens(error, 'error');
                })
                .finally(() => {
                    button.disabled = false;
                    button.innerText = 'Calcular';
                });
        });

    }

    document.addEventListener('DOMContentLoaded', function () {
        calculaLeads();
    });
}());