 <!-- Modal -->
                    <div class="modal fade" id="staticGenerate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Generer un qr Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="data:image/png;base64, {!! base64_encode($qrcode) !!} "><br/>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        </div>
                    </div>
