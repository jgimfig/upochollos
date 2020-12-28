package acciones;

import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.validator.annotations.RequiredStringValidator;
import java.io.File;
import java.util.Map;
import org.apache.commons.io.FileUtils;
import org.apache.struts2.ServletActionContext;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.TiendaDAO;
import pojos.Tienda;
import util.CONSTANTES;

public class CrearTienda extends ActionSupport implements SessionAware {

    Map<String, Object> SESION;

    private String nombreTienda;
    private File logo;

    public CrearTienda() {
    }

    public String getNombreTienda() {
        return nombreTienda;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setNombreTienda(String nombreTienda) {
        this.nombreTienda = nombreTienda;
    }

    public File getLogo() {
        return logo;
    }

    public void setLogo(File logo) {
        this.logo = logo;
    }

    @Override
    public void validate() {

        if (getLogo() == null) {
            addFieldError("logo", getText("campo.requerido"));
        } else {

            if (getLogo().length() > CONSTANTES.TAMANO_IMAGEN) {
                addFieldError("logo", getText("tamanio.archivo"));
            }
        }

    }

    public String execute() throws Exception {

        if (getNombreTienda() != null && getNombreTienda().length() > 0) {

            if (new TiendaDAO().read(getNombreTienda()) == null) {
                Tienda t = new Tienda(getNombreTienda(), getNombreTienda().toLowerCase().replace(" ", "_") + ".png");
                new TiendaDAO().create(t);
            }

            /* GENERAMOS UN NOMBRE DE ARCHIVO ÚNICO PARA LA IMAGEN SUBIDA, YA QUE VARIOS 
               ANUNCIOS PUEDEN COINCIDIR EN NOMBRE */
            if (getLogo() != null) {
                String filePath = ServletActionContext.getServletContext().getRealPath("/").concat("Vistas" + File.separator + "imagenes" + File.separator + "tiendas");
                String filePathDEV = filePath.replace("build" + File.separator, "");

                File fileToCreate = new File(filePath, (getNombreTienda() + ".png").toLowerCase().replace(" ", "_"));
                File fileToCreateDEV = new File(filePathDEV, (getNombreTienda() + ".png").toLowerCase().replace(" ", "_"));

                FileUtils.copyFile(getLogo(), fileToCreate);
                FileUtils.copyFile(getLogo(), fileToCreateDEV);
            }
        }

        getSESION().put("TIENDAS", new TiendaDAO().list());
        return SUCCESS;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

}
