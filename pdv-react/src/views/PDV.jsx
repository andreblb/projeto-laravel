import React, { useState } from 'react';
import api from '../api';

export default function PDV() {
  const [codigo, setCodigo] = useState("");
  const [carrinho, setCarrinho] = useState([]);
  const [modalOpen, setModalOpen] = useState(false);

  const adicionarItem = async (e) => {
    if (e.key === 'Enter' && codigo.trim()) {
      try {
        const { data } = await api.get(`/produtos/${codigo}`);
        setCarrinho(prev => [...prev, { ...data, id: Date.now(), qtd: 1 }]);
        setCodigo("");
      } catch (err) { alert("PRODUTO NÃO ENCONTRADO"); }
    }
  };

  const imprimirCupom = (id, total, forma) => {
    const pW = window.open('', '_blank', 'width=300,height=500');
    let itemsHtml = carrinho.map(i => `<li>${i.nome} - R$ ${i.preco}</li>`).join('');
    pW.document.write(`<html><body style="font-family: monospace;"><h1>CUPOM</h1><p>Venda: ${id}</p><ul>${itemsHtml}</ul><h3>TOTAL: R$ ${total.toFixed(2)}</h3><p>Pagamento: ${forma}</p></body></html>`);
    pW.document.close(); pW.print();
  };

  const finalizarCompra = async (forma) => {
    const total = carrinho.reduce((a, b) => a + parseFloat(b.preco), 0);
    try {
      const { data } = await api.post("/api/vendas", { total, forma_pagamento: forma, terminal: "PDV-01" });
      imprimirCupom(data.venda_id, total, forma);
      setModalOpen(false);
      setCarrinho([]);
    } catch (err) { alert("Erro ao finalizar"); }
  };

  return (
    <div className="pdv-grid">
      <aside><h2>PROMOÇÕES</h2></aside>
      
      <main className="main-content">
        <input autoFocus value={codigo} onChange={e => setCodigo(e.target.value)} onKeyDown={adicionarItem} placeholder="> DIGITE O CODIGO" />
        <table>
          <thead><tr><th>ITEM</th><th>QTD</th><th>VALOR</th></tr></thead>
          <tbody>
            {carrinho.map(item => <tr key={item.id}><td>{item.nome}</td><td>{item.qtd}</td><td>R$ {item.preco}</td></tr>)}
          </tbody>
        </table>
      </main>

      <footer className="rodape">
        <div className="subtotal">TOTAL: R$ {carrinho.reduce((a, b) => a + parseFloat(b.preco), 0).toFixed(2)}</div>
        <button className="btn-finalizar" onClick={() => carrinho.length > 0 && setModalOpen(true)}>FINALIZAR [F10]</button>
      </footer>

      {modalOpen && (
        <div style={{position:'fixed', top:0, left:0, width:'100%', height:'100%', background:'#000', display:'flex', flexDirection:'column', justifyContent:'center', alignItems:'center', zIndex:999}}>
          <h2 style={{color:'#00e676'}}>FORMA DE PAGAMENTO</h2>
          {['PIX', 'DINHEIRO', 'DEBITO', 'CREDITO'].map(p => (
            <button key={p} style={{width:'300px', margin:'10px', padding:'20px', background:'#00e676', border:'none', fontSize:'1.2rem'}} onClick={() => finalizarCompra(p)}>{p}</button>
          ))}
          <button style={{background:'none', border:'1px solid #00e676', color:'#00e676', padding:'10px 20px'}} onClick={() => setModalOpen(false)}>CANCELAR</button>
        </div>
      )}
    </div>
  );
}