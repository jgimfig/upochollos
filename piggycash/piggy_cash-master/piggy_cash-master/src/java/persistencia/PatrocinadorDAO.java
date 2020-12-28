package persistencia;

import java.util.ArrayList;
import java.util.List;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import pojos.Patrocinador;

public class PatrocinadorDAO implements DAO<Patrocinador, String>{
    
    private Session sesion = null;

    @Override
    public void create(Patrocinador elemento) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.save(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public void update(Patrocinador elemento) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query q =  sesion.createQuery("update Patrocinador set nombre = '"+elemento.getNombre()+"' where cif = '"+elemento.getCif()+"'");
            q.executeUpdate();
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public void delete(Patrocinador elemento) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.delete(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }
    
    
    /*DADO UNA PK, BORRA EL ELEMENTO*/
    public void delete(String pk) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();

            Query q1 = sesion.createQuery("delete from Anuncio a where a.patrocinador.cif = '"+pk+"'");
            Query q2 = sesion.createQuery("delete from Patrocinador p  where p.cif='" + pk + "'");

            q1.executeUpdate();
            q2.executeUpdate();

            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }
    

    @Override
    public Patrocinador read(String primaryKey) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Patrocinador where cif='"+primaryKey+"'");
            tx.commit();
            return (Patrocinador) query.uniqueResult();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<Patrocinador> list() {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Patrocinador");
            tx.commit();
            return query.list();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<String> listPK() {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        List<String> listaNombres = new ArrayList<>();
        List<Patrocinador> listaPatrocinadores;
        try {
            tx = sesion.beginTransaction();
            listaPatrocinadores = list();
            for(int i = 0; i < listaPatrocinadores.size(); i++){
                listaNombres.add(listaPatrocinadores.get(i).getCif());
            }
            tx.commit();
            return listaNombres;
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }
}
