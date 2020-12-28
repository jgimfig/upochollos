package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.Collections;
import java.util.List;
import persistencia.AnuncioDAO;
import persistencia.ProductoDAO;
import pojos.Anuncio;
import pojos.Producto;

public class CargarChollosAction extends ActionSupport {

    private int ultimoCholloCargado;
    private String productos;
    private String categoria;

    public static final int SALTO = 5;

    public CargarChollosAction() {

    }

    public String getProductos() {
        return productos;
    }

    public void setProductos(String productos) {
        this.productos = productos;
    }

    public int getUltimoCholloCargado() {
        return ultimoCholloCargado;
    }

    public void setUltimoCholloCargado(int ultimoCholloCargado) {
        this.ultimoCholloCargado = ultimoCholloCargado;
    }

    public String getCategoria() {
        return categoria;
    }

    public void setCategoria(String categoria) {
        this.categoria = categoria;
    }
    
    

    @Override
    public String execute() throws Exception {
        
        /*
        SE MANDA A UN JSP QUE HACE LAS VECES DE DATA HANDLER, SE MANDA LA INFORMACIÓN DE FORMA ASINCRONA
        MEDIANTE AJAX
        */

        List<Integer> listaChollosPK = new ProductoDAO().listPK(getUltimoCholloCargado(), SALTO, getCategoria());
        String datosProductos = "";

        Anuncio anuncio = null;

        try {
            List<Anuncio> anuncios = new AnuncioDAO().list();
            Collections.shuffle(anuncios);
            anuncio = anuncios.get(0);
        } catch (Exception ex) {

        }

        for (Integer i : listaChollosPK) {

            Producto p = new ProductoDAO().read(i);

            String nombre = p.getNombre();

            if (nombre.length() > 13) {
                nombre = nombre.substring(0, 10) + "...";
            }

            datosProductos += nombre
                    + "_" + p.getPrecioDescuento()
                    + "_" + p.getPrecioOriginal()
                    + "_" + p.getImagen()
                    + "_" + p.getId()
                    + "$";
        }

        if (anuncio != null) {
            datosProductos += "Anuncio"
                    + "_" + anuncio.getTitulo()
                    + "_" + anuncio.getDescripcion()
                    + "_" + anuncio.getContenidoMultimedia()
                    + "_" + "anuncio-" + anuncio.getId() + "" + ultimoCholloCargado
                    + "$";
        }

        if (datosProductos.length() > 1) {
            datosProductos = datosProductos.substring(0, datosProductos.length() - 1);
        }

        setUltimoCholloCargado(getUltimoCholloCargado() + listaChollosPK.size());

        datosProductos = getUltimoCholloCargado() + ":" + datosProductos;

        setProductos(datosProductos);

        return SUCCESS;
    }

}
