package acciones;

import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.validator.annotations.RequiredFieldValidator;
import com.opensymphony.xwork2.validator.annotations.RequiredStringValidator;
import java.io.File;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Map;
import java.util.UUID;
import org.apache.commons.io.FileUtils;
import org.apache.struts2.ServletActionContext;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.AnuncioDAO;
import persistencia.PatrocinadorDAO;
import pojos.Anuncio;
import pojos.Patrocinador;

public class CrearAnuncio extends ActionSupport implements SessionAware {

    private String idAnuncio, cifPatrocinadorAnuncio, tituloAnuncio, fechaInicioAnuncio, fechaFinAnuncio, descripcionAnuncio;

    private float cuantiaAnuncio;

    File contenidoMultAnuncio;

    Map<String, Object> SESION;

    public CrearAnuncio() {
    }

    public String getIdAnuncio() {
        return idAnuncio;
    }

    public void setIdAnuncio(String idAnuncio) {
        this.idAnuncio = idAnuncio;
    }

    public String getCifPatrocinadorAnuncio() {
        return cifPatrocinadorAnuncio;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setCifPatrocinadorAnuncio(String cifPatrocinador) {
        this.cifPatrocinadorAnuncio = cifPatrocinador;
    }

    public String getTituloAnuncio() {
        return tituloAnuncio;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setTituloAnuncio(String tituloAnuncio) {
        this.tituloAnuncio = tituloAnuncio;
    }

    public String getFechaInicioAnuncio() {
        return fechaInicioAnuncio;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setFechaInicioAnuncio(String fechaInicioAnuncio) {
        this.fechaInicioAnuncio = fechaInicioAnuncio;
    }

    public String getFechaFinAnuncio() {
        return fechaFinAnuncio;
    }

    public void setFechaFinAnuncio(String fechaFinAnuncio) {
        this.fechaFinAnuncio = fechaFinAnuncio;
    }

    public String getDescripcionAnuncio() {
        return descripcionAnuncio;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setDescripcionAnuncio(String descripcionAnuncio) {
        this.descripcionAnuncio = descripcionAnuncio;
    }

    public float getCuantiaAnuncio() {
        return cuantiaAnuncio;
    }

    @RequiredFieldValidator(key = "campo.requerido")
    public void setCuantiaAnuncio(float cuantiaAnuncio) {
        this.cuantiaAnuncio = cuantiaAnuncio;
    }

    public File getContenidoMultAnuncio() {
        return contenidoMultAnuncio;
    }

    public void setContenidoMultAnuncio(File contenidoMultAnuncio) {
        this.contenidoMultAnuncio = contenidoMultAnuncio;
    }

    public void validate() {

        try {
            new SimpleDateFormat("dd/MM/yyyy").parse(getFechaInicioAnuncio());
        } catch (Exception ex) {
            addFieldError("fechaInicioAnuncio", getText("formato.fecha"));
        }
        try {
            new SimpleDateFormat("dd/MM/yyyy").parse(getFechaFinAnuncio());
        } catch (Exception ex) {
            addFieldError("fechaPubCupon", getText("formato.fecha"));
        }

        try {
            Date fp = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaInicioAnuncio());
            Date fv = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaFinAnuncio());

            if (fp.after(fv)) {
                addFieldError("fechaFinAnuncio", getText("viaje.en.el.tiempo"));
            }

        } catch (Exception e) {

        }
    }

    public String execute() throws Exception {
        Anuncio a = null;

        try {
            if (getIdAnuncio() != null || getIdAnuncio().length() > 0) {
                a = new AnuncioDAO().read(Integer.parseInt(getIdAnuncio()));
            }
        } catch (Exception e) {

        }

        Patrocinador p = new PatrocinadorDAO().read(getCifPatrocinadorAnuncio());

        Date fechaInicio = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaInicioAnuncio());
        Date fechaFin = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaFinAnuncio());

        
        /* GENERAMOS UN NOMBRE DE ARCHIVO ÚNICO PARA LA IMAGEN SUBIDA, YA QUE VARIOS ANUNCIOS PUEDEN COINCIDIR EN NOMBRE */
        String filename = "";
        if (getContenidoMultAnuncio() != null) {

            filename = UUID.randomUUID().toString() + ".png";

            String filePath = ServletActionContext.getServletContext().getRealPath("/").concat("Vistas" + File.separator + "imagenes" + File.separator + "anuncios");
            String filePathDEV = filePath.replace("build" + File.separator, "");

            File fileToCreate = new File(filePath, filename.toLowerCase());
            File fileToCreateDEV = new File(filePathDEV, filename.toLowerCase());

            FileUtils.copyFile(getContenidoMultAnuncio(), fileToCreate);
            FileUtils.copyFile(getContenidoMultAnuncio(), fileToCreateDEV);

            if (a != null && a.getContenidoMultimedia() != null && a.getContenidoMultimedia().length() > 0) {
                File f1 = new File(filePath + File.separator + a.getContenidoMultimedia());
                File f2 = new File(filePathDEV + File.separator + a.getContenidoMultimedia());
                f1.delete();
                f2.delete();
            }

        }

        if (a != null) {
            a.setTitulo(getTituloAnuncio());
            a.setPatrocinador(p);
            a.setFechaInicio(fechaInicio);
            a.setFechaFin(fechaFin);
            a.setDescripcion(getDescripcionAnuncio());
            a.setCuantia(getCuantiaAnuncio());

            if (filename.length() > 0) {
                a.setContenidoMultimedia("" + filename);
            }

            new AnuncioDAO().update(a);
        } else {
            a = new Anuncio();
            a.setTitulo(getTituloAnuncio());
            a.setPatrocinador(p);
            a.setFechaInicio(fechaInicio);
            a.setFechaFin(fechaFin);
            a.setDescripcion(getDescripcionAnuncio());
            a.setCuantia(getCuantiaAnuncio());

            if (filename.length() > 0) {
                a.setContenidoMultimedia("" + filename);
            }

            new AnuncioDAO().create(a);
        }

        getSESION().put("ANUNCIOS", new AnuncioDAO().list());

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
