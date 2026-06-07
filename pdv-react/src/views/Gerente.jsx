import React, { useState, useEffect } from 'react';
import api from '../api';

export default function Gerente() {
  const [caixas, setCaixas] = useState([]);
  const [valorSangria, setValorSangria] = useState("");

  useEffect(() => {
    // Busca o saldo atual do caixa
    api.get("/api/vendas/status-caixa")
      .then(res => setCaixas(res.data))
      .catch(err => console.error("Erro ao carregar dados:", err));
  }, []);

  const carregarRelatorio = async (periodo) => {
    try {
      const { data } = await api.get(`/api/vendas/relatorio?periodo=${periodo}`);
      
      // Abre uma nova janela para o relatório
      const pW = window.open('', '_blank', 'width=400,height=600');
      
      let html = `
        <html>
          <head>
            <style>
              body { font-family: 'Courier New', monospace; padding: 20px; }
              h2 { border-bottom: 2px solid #000; padding-bottom: 10px; }
              .item { display: flex; justify-content: space-between; margin: 10px 0; }
              .total { font-weight: bold; border-top: 2px solid #000; margin-top: 20px; padding-top: 10px; }
              button { background: #000; color: #00e676; padding: 10px; cursor: pointer; border: 1px solid #00e676; }
            </style>
          </head>
          <body>
            <h2>RELATÓRIO ${periodo.toUpperCase()}</h2>
            ${data.map(item => `
              <div class="item">
                <span>${item.forma_pagamento}</span>
                <span>R$ ${parseFloat(item.total).toFixed(2)}</span>
              </div>
            `).join('')}
            <div class="total">
              TOTAL GERAL: R$ ${data.reduce((a, b) => a + parseFloat(b.total), 0).toFixed(2)}
            </div>
            <button onclick="window.print()">IMPRIMIR RELATÓRIO</button>
          </body>
        </html>
      `;
      
      pW.document.write(html);
      pW.document.close();
    } catch (err) { 
      alert("Erro ao carregar relatório"); 
    }
  };

  const realizarSangria = async () => {
    if (!valorSangria || valorSangria <= 0) return alert("Insira um valor válido");
    try {
      await api.post("/api/sangria", { valor: valorSangria });
      alert("Sangria de R$ " + valorSangria + " realizada!");
      setValorSangria("");
    } catch (err) { alert("Erro ao processar sangria"); }
  };

  return (
    <div className="pdv-grid" style={{ display: 'block', padding: '40px' }}>
      <h1 style={{ color: '#00e676', marginBottom: '30px' }}>PAINEL DE GERÊNCIA</h1>
      
      {/* Cards de Saldo */}
      <div style={{ display: 'flex', gap: '20px', marginBottom: '40px' }}>
        {caixas.map(c => (
          <div key={c.id} style={{ border: '2px solid #00e676', padding: '25px', minWidth: '200px' }}>
            <h3 style={{ margin: '0 0 10px 0' }}>{c.nome}</h3>
            <p className="subtotal" style={{ margin: 0 }}>R$ {c.saldo}</p>
          </div>
        ))}
      </div>

      {/* Relatórios */}
      <section style={{ borderTop: '2px solid #00e676', paddingTop: '20px', marginBottom: '30px' }}>
        <h3>RELATÓRIOS E FECHAMENTOS</h3>
        <div style={{ display: 'flex', gap: '15px', marginTop: '15px' }}>
          <button className="btn-finalizar" onClick={() => carregarRelatorio('diario')}>DIÁRIO</button>
          <button className="btn-finalizar" onClick={() => carregarRelatorio('quinzenal')}>QUINZENAL</button>
          <button className="btn-finalizar" onClick={() => carregarRelatorio('mensal')}>MENSAL</button>
        </div>
      </section>

      {/* Sangria */}
      <section style={{ borderTop: '2px solid #00e676', paddingTop: '20px' }}>
        <h3>REALIZAR SANGRIA DE CAIXA</h3>
        <div style={{ display: 'flex', gap: '15px', marginTop: '15px', alignItems: 'center' }}>
          <input 
            type="number" 
            placeholder="VALOR R$" 
            value={valorSangria} 
            onChange={(e) => setValorSangria(e.target.value)}
            style={{ width: '200px' }}
          />
          <button className="btn-finalizar" onClick={realizarSangria}>CONFIRMAR SANGRIA</button>
        </div>
      </section>
    </div>
  );
}