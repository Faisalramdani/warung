import React, { Component } from 'react';
import { Button,Modal } from 'react-bootstrap';
import { sum } from 'lodash';
class ModalDialog extends Component{

    constructor(props) {
        super(props);
        this.state = {
            show: false
        };

        this.handleShow = this.handleShow.bind(this);
        this.handleClose = this.handleClose.bind(this);

    }


    handleClose = () => {
        this.setState({
            show: false
          });
    }

    handleShow (){
        this.setState(prevState => ({
            show: !prevState.show
          }));
    }

    render(){
        const { show } = this.state;
        return (
            <>
            <Button type="button" className="btn btn-primary btn-block" disabled={this.props.cart} variant="primary" onClick={this.handleShow}>
                Submit
            </Button>

            <Modal show={show} onHide={this.handleClose}>
                <form onSubmit={this.props.handleSubmit}>
                    <Modal.Header closeButton>
                        <Modal.Title>Kalkulasi pembayaran</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                            <input type="text" className="form-control" placeholder="Masukan jumlah uang.." name="amount" value={this.props.value} onChange={this.props.onChange}></input>
                            <li> Harga Produk : {window.APP.currency_symbol} {(this.props.change)}</li>
                            <li> Total kembalian : {window.APP.currency_symbol}  {sum(this.props.kembalian) - sum(this.props.change)}</li>
                    </Modal.Body>
                    <Modal.Footer>
                        <Button variant="secondary" onClick={this.handleClose}>
                        Batal
                        </Button>
                        <Button type="submit" variant="primary" onClick={this.handleClose}>
                        Proses pembayaran
                        </Button>
                    </Modal.Footer>
                </form>
            </Modal>
            </>
        )
    }
}

export default ModalDialog;

