package acciones;

import static com.opensymphony.xwork2.Action.ERROR;
import static com.opensymphony.xwork2.Action.SUCCESS;
import com.opensymphony.xwork2.ActionSupport;
import java.io.File;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Map;
import java.util.UUID;
import org.apache.commons.io.FileUtils;
import org.apache.struts2.ServletActionContext;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.CategoriaDAO;
import persistencia.ProductoDAO;
import persistencia.TiendaDAO;
import pojos.Categoria;
import pojos.Producto;
import pojos.Tienda;
import pojos.Usuario;

public class EditarChollo extends ActionSupport implements SessionAware {

    Map<String, Object> SESION;

    private String nombreChollo;
    private String enlaceChollo;
    private String precioActual;
    private String precioAnterior;
    private String descripcion;
    private String nombreCategoria;
    private String nombreTienda;
    private String fechaVencimiento;
    private String idProducto;

    private File imagenProducto;

    Producto p;

    public EditarChollo() {
    }

    public String getNombreChollo() {
        return nombreChollo;
    }

    public void setNombreChollo(String nombreChollo) {
        this.nombreChollo = nombreChollo;
    }

    public String getEnlaceChollo() {
        return enlaceChollo;
    }

    public void setEnlaceChollo(String enlaceChollo) {
        this.enlaceChollo = enlaceChollo;
    }

    public String getPrecioActual() {
        return precioActual;
    }

    public void setPrecioActual(String precioActual) {
        this.precioActual = precioActual;
    }

    public String getPrecioAnterior() {
        return precioAnterior;
    }

    public void setPrecioAnterior(String precioAnterior) {
        this.precioAnterior = precioAnterior;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public String getNombreCategoria() {
        return nombreCategoria;
    }

    public void setNombreCategoria(String nombreCategoria) {
        this.nombreCategoria = nombreCategoria;
    }

    public String getNombreTienda() {
        return nombreTienda;
    }

    public void setNombreTienda(String nombreTienda) {
        this.nombreTienda = nombreTienda;
    }

    public String getFechaVencimiento() {
        return fechaVencimiento;
    }

    public void setFechaVencimiento(String fechaVencimiento) {
        this.fechaVencimiento = fechaVencimiento;
    }

    public File getImagenProducto() {
        return imagenProducto;
    }

    public void setImagenProducto(File imagenProducto) {
        this.imagenProducto = imagenProducto;
    }

    public String getIdProducto() {
        return idProducto;
    }

    public void setIdProducto(String idProducto) {
        this.idProducto = idProducto;
    }

    public Producto getP() {
        return p;
    }

    public void setP(Producto p) {
        this.p = p;
    }

    public String execute() throws Exception {

        try {
            Categoria c = new CategoriaDAO().read(getNombreCategoria());
            Tienda t = new TiendaDAO().read(getNombreTienda());
            Usuario u = (Usuario) getSESION().get("USUARIO");

            Date fechaVencimiento = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaVencimiento());

            String filename = UUID.randomUUID().toString() + ".png";

            setP(new ProductoDAO().read(Integer.parseInt(getIdProducto())));
            getP().setCategoria(c);
            getP().setTienda(t);
            getP().setFechaVencimiento(fechaVencimiento);
            getP().setNombre(getNombreChollo());
            getP().setEnlace(getEnlaceChollo());
            getP().setDescripcion(getDescripcion());
            getP().setPrecioDescuento(Float.parseFloat(getPrecioActual()));
            getP().setPrecioOriginal(Float.parseFloat(getPrecioAnterior()));

            /* GENERAMOS UN NOMBRE DE ARCHIVO ÚNICO PARA LA IMAGEN SUBIDA, 
               YA QUE VARIOS ANUNCIOS PUEDEN COINCIDIR EN NOMBRE */
            if (getImagenProducto() != null) {
                String filePath = ServletActionContext.getServletContext().getRealPath("/").concat("Vistas" + File.separator + "imagenes" + File.separator + "productos");
                String filePathDEV = filePath.replace("build" + File.separator, "");

                File fileToCreate = new File(filePath, (filename).toLowerCase());
                File fileToCreateDEV = new File(filePathDEV, (filename).toLowerCase());

                FileUtils.copyFile(getImagenProducto(), fileToCreate);
                FileUtils.copyFile(getImagenProducto(), fileToCreateDEV);

                getP().setImagen(filename);
            }

            new ProductoDAO().update(getP());

            return SUCCESS;

        } catch (Exception ex) {

        }

        return ERROR;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

}
