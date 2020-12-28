package acciones;

import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.validator.annotations.RequiredStringValidator;
import com.opensymphony.xwork2.validator.annotations.UrlValidator;
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

public class CrearChollo extends ActionSupport implements SessionAware {

    Map<String, Object> SESION;

    private String nombreChollo;
    private String enlaceChollo;
    private String precioActual;
    private String precioAnterior;
    private String descripcion;
    private String nombreCategoria;
    private String nombreTienda;
    private String fechaVencimiento;

    private File imagenProducto;

    public CrearChollo() {
    }

    public String getNombreChollo() {
        return nombreChollo;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setNombreChollo(String nombreChollo) {
        this.nombreChollo = nombreChollo;
    }

    public String getEnlaceChollo() {
        return enlaceChollo;
    }

    @UrlValidator(key = "url.incorrecta")
    @RequiredStringValidator(key = "campo.requerido")
    public void setEnlaceChollo(String enlaceChollo) {
        this.enlaceChollo = enlaceChollo;
    }

    public String getPrecioActual() {
        return precioActual;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setPrecioActual(String precioActual) {
        this.precioActual = precioActual;
    }

    public String getPrecioAnterior() {
        return precioAnterior;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setPrecioAnterior(String precioAnterior) {
        this.precioAnterior = precioAnterior;
    }

    public String getDescripcion() {
        return descripcion;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public String getNombreCategoria() {
        return nombreCategoria;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setNombreCategoria(String nombreCategoria) {
        this.nombreCategoria = nombreCategoria;
    }

    public File getImagenProducto() {
        return imagenProducto;
    }

    public void setImagenProducto(File imagenProducto) {
        this.imagenProducto = imagenProducto;
    }

    public String getNombreTienda() {
        return nombreTienda;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setNombreTienda(String nombreTienda) {
        this.nombreTienda = nombreTienda;
    }

    public String getFechaVencimiento() {
        return fechaVencimiento;
    }

    @RequiredStringValidator(key = "campo.requerido")

    public void setFechaVencimiento(String fechaVencimiento) {
        this.fechaVencimiento = fechaVencimiento;
    }

    @Override
    public void validate() {

        try {
            Float.parseFloat(this.getPrecioActual());
        } catch (Exception e) {
            addFieldError("precioActual", getText("precio.numerico"));

        }

        try {
            Float.parseFloat(this.getPrecioAnterior());
        } catch (Exception e) {
            addFieldError("precioAnterior", getText("precio.numerico"));
        }

        try {
            Date d = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaVencimiento());

            if (d.before(new Date())) {
                addFieldError("fechaVencimiento", getText("viaje.en.el.tiempo"));
            }

        } catch (Exception ex) {
            addFieldError("fechaVencimiento", getText("formato.fecha"));
        }
    }

    @Override
    public String execute() throws Exception {

        Categoria c = new CategoriaDAO().read(getNombreCategoria());
        Tienda t = new TiendaDAO().read(getNombreTienda());
        Usuario u = (Usuario) getSESION().get("USUARIO");

        Date fechaVencimiento = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaVencimiento());

        /* GENERAMOS UN NOMBRE DE ARCHIVO ÚNICO PARA LA IMAGEN SUBIDA, YA QUE VARIOS ANUNCIOS PUEDEN COINCIDIR EN NOMBRE */
        String filename = UUID.randomUUID().toString() + ".png";

        Producto p = new Producto(u, getEnlaceChollo(), Float.parseFloat(getPrecioAnterior()), getNombreChollo(), new Date(), Float.parseFloat(getPrecioActual()), getDescripcion(), filename);
        p.setCategoria(c);
        p.setTienda(t);
        p.setFechaVencimiento(fechaVencimiento);

        if (getImagenProducto() != null) {
            String filePath = ServletActionContext.getServletContext().getRealPath("/").concat("Vistas" + File.separator + "imagenes" + File.separator + "productos");
            String filePathDEV = filePath.replace("build" + File.separator, "");

            File fileToCreate = new File(filePath, (filename).toLowerCase());
            File fileToCreateDEV = new File(filePathDEV, (filename).toLowerCase());

            FileUtils.copyFile(getImagenProducto(), fileToCreate);
            FileUtils.copyFile(getImagenProducto(), fileToCreateDEV);

            new ProductoDAO().create(p);

            return SUCCESS;
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
