
package it.isharedoc.schemas.instance;

import java.math.BigDecimal;
import java.math.BigInteger;
import javax.xml.bind.JAXBElement;
import javax.xml.bind.annotation.XmlElementDecl;
import javax.xml.bind.annotation.XmlRegistry;
import javax.xml.datatype.XMLGregorianCalendar;
import javax.xml.namespace.QName;


/**
 * This object contains factory methods for each 
 * Java content interface and Java element interface 
 * generated in the it.isharedoc.schemas.instance package. 
 * <p>An ObjectFactory allows you to programatically 
 * construct new instances of the Java representation 
 * for XML content. The Java representation of XML 
 * content can consist of schema derived interfaces 
 * and classes representing the binding of schema 
 * type definitions, element declarations and model 
 * groups.  Factory methods for each of these are 
 * provided in this class.
 * 
 */
@XmlRegistry
public class ObjectFactory {

    private final static QName _InstanceMessageUpdateRequestAttachmentsAttachmentContentType_QNAME = new QName("", "contentType");
    private final static QName _InstanceSignalRequestVariablesVariableValueDate_QNAME = new QName("", "valueDate");
    private final static QName _InstanceSignalRequestVariablesVariableValueBoolean_QNAME = new QName("", "valueBoolean");
    private final static QName _InstanceSignalRequestVariablesVariableValueDecimal_QNAME = new QName("", "valueDecimal");
    private final static QName _InstanceSignalRequestVariablesVariableValueString_QNAME = new QName("", "valueString");
    private final static QName _InstanceSignalRequestVariablesVariableValueInteger_QNAME = new QName("", "valueInteger");
    private final static QName _InstanceMessageCreateRequestTags_QNAME = new QName("", "tags");
    private final static QName _InstanceMessageCreateRequestExtAppIdentifierDate_QNAME = new QName("", "extAppIdentifierDate");
    private final static QName _InstanceMessageCreateRequestBody_QNAME = new QName("", "body");
    private final static QName _InstanceMessageCreateRequestStartWorkflow_QNAME = new QName("", "startWorkflow");
    private final static QName _InstanceMessageCreateRequestSubject_QNAME = new QName("", "subject");
    private final static QName _InstanceMessageCreateRequestContacts_QNAME = new QName("", "contacts");
    private final static QName _InstanceMessageCreateRequestVariables_QNAME = new QName("", "variables");
    private final static QName _InstanceMessageCreateRequestTopics_QNAME = new QName("", "topics");
    private final static QName _InstanceMessageCreateRequestReferences_QNAME = new QName("", "references");
    private final static QName _InstanceMessageCreateRequestExtAppIdentifier_QNAME = new QName("", "extAppIdentifier");
    private final static QName _InstanceMessageCreateRequestInstanceOperation_QNAME = new QName("", "instanceOperation");
    private final static QName _InstanceMessageCreateRequestScheduledSendDate_QNAME = new QName("", "scheduledSendDate");
    private final static QName _InstanceMessageCreateRequestAttachments_QNAME = new QName("", "attachments");
    private final static QName _InstanceMessageCreateRequestMetaViewName_QNAME = new QName("", "metaViewName");
    private final static QName _InstanceMessageCreateRequestNote_QNAME = new QName("", "note");
    private final static QName _InstanceActivityCreateResponseIdentifierDate_QNAME = new QName("", "identifierDate");
    private final static QName _InstanceActivityCreateResponseIdentifier_QNAME = new QName("", "identifier");
    private final static QName _InstanceActivityCreateResponseViewUrl_QNAME = new QName("", "viewUrl");
    private final static QName _InstanceMessageCreateRequestContactsContactInfo1_QNAME = new QName("", "info1");
    private final static QName _InstanceMessageCreateRequestContactsContactInfo3_QNAME = new QName("", "info3");
    private final static QName _InstanceMessageCreateRequestContactsContactInfo2_QNAME = new QName("", "info2");
    private final static QName _InstanceSearchResponseItems_QNAME = new QName("", "items");
    private final static QName _InstanceSearchRequestArchivied_QNAME = new QName("", "archivied");
    private final static QName _InstanceSearchRequestFolder_QNAME = new QName("", "folder");
    private final static QName _InstanceSearchRequestOrganization_QNAME = new QName("", "organization");
    private final static QName _InstanceSearchRequestMax_QNAME = new QName("", "max");
    private final static QName _InstanceSearchRequestSort_QNAME = new QName("", "sort");
    private final static QName _InstanceSearchRequestScope_QNAME = new QName("", "scope");
    private final static QName _InstanceSearchRequestWorknode_QNAME = new QName("", "worknode");
    private final static QName _InstanceSearchRequestStart_QNAME = new QName("", "start");
    private final static QName _InstanceSearchRequestMessagebox_QNAME = new QName("", "messagebox");
    private final static QName _InstanceSearchRequestDeleted_QNAME = new QName("", "deleted");
    private final static QName _InstanceSearchRequestSpotlight_QNAME = new QName("", "spotlight");
    private final static QName _InstanceActivityCreateRequestReferencesReferenceId_QNAME = new QName("", "id");
    private final static QName _InstanceActivityCreateRequestReferencesReferenceAppIdentifier_QNAME = new QName("", "appIdentifier");
    private final static QName _InstanceActivityCreateRequestReferencesReferenceAppIdentifierDate_QNAME = new QName("", "appIdentifierDate");
    private final static QName _InstanceDetailResponseContactsContactReferenceCode_QNAME = new QName("", "referenceCode");
    private final static QName _InstanceDetailResponseContactsContactExternalId_QNAME = new QName("", "externalId");
    private final static QName _TaskSearchResponseItemsItemInstanceTitle_QNAME = new QName("", "title");
    private final static QName _TaskSearchResponseItemsItemInstanceStatus_QNAME = new QName("", "status");
    private final static QName _TaskSearchResponseItemsItemInstanceSbName_QNAME = new QName("", "sbName");
    private final static QName _InstanceDetailResponseDirection_QNAME = new QName("", "direction");
    private final static QName _TaskSearchRequestTaskDefinitionKey_QNAME = new QName("", "taskDefinitionKey");
    private final static QName _TaskSearchRequestOwner_QNAME = new QName("", "owner");
    private final static QName _TaskSearchRequestInstanceId_QNAME = new QName("", "instanceId");
    private final static QName _TaskSearchRequestAssignee_QNAME = new QName("", "assignee");
    private final static QName _TaskSearchRequestStoryboardCode_QNAME = new QName("", "storyboardCode");
    private final static QName _TaskSearchRequestDueDate_QNAME = new QName("", "dueDate");
    private final static QName _TaskSearchRequestCompleted_QNAME = new QName("", "completed");
    private final static QName _TaskCompleteResponseMessage_QNAME = new QName("", "message");
    private final static QName _InstanceSearchResponseItemsItemTo_QNAME = new QName("", "to");
    private final static QName _InstanceSearchResponseItemsItemFrom_QNAME = new QName("", "from");
    private final static QName _InstanceSearchResponseItemsItemMboxName_QNAME = new QName("", "mboxName");
    private final static QName _InstanceSearchResponseItemsItemCc_QNAME = new QName("", "cc");
    private final static QName _TaskSearchResponseItemsItemPriority_QNAME = new QName("", "priority");

    /**
     * Create a new ObjectFactory that can be used to create new instances of schema derived classes for package: it.isharedoc.schemas.instance
     * 
     */
    public ObjectFactory() {
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest }
     * 
     */
    public InstanceMessageCreateRequest createInstanceMessageCreateRequest() {
        return new InstanceMessageCreateRequest();
    }

    /**
     * Create an instance of {@link InstanceSearchResponse }
     * 
     */
    public InstanceSearchResponse createInstanceSearchResponse() {
        return new InstanceSearchResponse();
    }

    /**
     * Create an instance of {@link InstanceMessageUpdateRequest }
     * 
     */
    public InstanceMessageUpdateRequest createInstanceMessageUpdateRequest() {
        return new InstanceMessageUpdateRequest();
    }

    /**
     * Create an instance of {@link TaskCompleteRequest }
     * 
     */
    public TaskCompleteRequest createTaskCompleteRequest() {
        return new TaskCompleteRequest();
    }

    /**
     * Create an instance of {@link TaskSearchRequest }
     * 
     */
    public TaskSearchRequest createTaskSearchRequest() {
        return new TaskSearchRequest();
    }

    /**
     * Create an instance of {@link TaskSearchResponse }
     * 
     */
    public TaskSearchResponse createTaskSearchResponse() {
        return new TaskSearchResponse();
    }

    /**
     * Create an instance of {@link InstanceActivityCreateRequest }
     * 
     */
    public InstanceActivityCreateRequest createInstanceActivityCreateRequest() {
        return new InstanceActivityCreateRequest();
    }

    /**
     * Create an instance of {@link InstanceSignalRequest }
     * 
     */
    public InstanceSignalRequest createInstanceSignalRequest() {
        return new InstanceSignalRequest();
    }

    /**
     * Create an instance of {@link InstanceDetailResponse }
     * 
     */
    public InstanceDetailResponse createInstanceDetailResponse() {
        return new InstanceDetailResponse();
    }

    /**
     * Create an instance of {@link InstanceDetailResponse.Attachments }
     * 
     */
    public InstanceDetailResponse.Attachments createInstanceDetailResponseAttachments() {
        return new InstanceDetailResponse.Attachments();
    }

    /**
     * Create an instance of {@link InstanceDetailResponse.Variables }
     * 
     */
    public InstanceDetailResponse.Variables createInstanceDetailResponseVariables() {
        return new InstanceDetailResponse.Variables();
    }

    /**
     * Create an instance of {@link InstanceDetailResponse.Contacts }
     * 
     */
    public InstanceDetailResponse.Contacts createInstanceDetailResponseContacts() {
        return new InstanceDetailResponse.Contacts();
    }

    /**
     * Create an instance of {@link InstanceSignalRequest.Variables }
     * 
     */
    public InstanceSignalRequest.Variables createInstanceSignalRequestVariables() {
        return new InstanceSignalRequest.Variables();
    }

    /**
     * Create an instance of {@link InstanceActivityCreateRequest.References }
     * 
     */
    public InstanceActivityCreateRequest.References createInstanceActivityCreateRequestReferences() {
        return new InstanceActivityCreateRequest.References();
    }

    /**
     * Create an instance of {@link InstanceActivityCreateRequest.Attachments }
     * 
     */
    public InstanceActivityCreateRequest.Attachments createInstanceActivityCreateRequestAttachments() {
        return new InstanceActivityCreateRequest.Attachments();
    }

    /**
     * Create an instance of {@link InstanceActivityCreateRequest.Variables }
     * 
     */
    public InstanceActivityCreateRequest.Variables createInstanceActivityCreateRequestVariables() {
        return new InstanceActivityCreateRequest.Variables();
    }

    /**
     * Create an instance of {@link TaskSearchResponse.Items }
     * 
     */
    public TaskSearchResponse.Items createTaskSearchResponseItems() {
        return new TaskSearchResponse.Items();
    }

    /**
     * Create an instance of {@link TaskSearchResponse.Items.Item }
     * 
     */
    public TaskSearchResponse.Items.Item createTaskSearchResponseItemsItem() {
        return new TaskSearchResponse.Items.Item();
    }

    /**
     * Create an instance of {@link TaskSearchRequest.Variables }
     * 
     */
    public TaskSearchRequest.Variables createTaskSearchRequestVariables() {
        return new TaskSearchRequest.Variables();
    }

    /**
     * Create an instance of {@link TaskCompleteRequest.Variables }
     * 
     */
    public TaskCompleteRequest.Variables createTaskCompleteRequestVariables() {
        return new TaskCompleteRequest.Variables();
    }

    /**
     * Create an instance of {@link InstanceMessageUpdateRequest.Attachments }
     * 
     */
    public InstanceMessageUpdateRequest.Attachments createInstanceMessageUpdateRequestAttachments() {
        return new InstanceMessageUpdateRequest.Attachments();
    }

    /**
     * Create an instance of {@link InstanceMessageUpdateRequest.Variables }
     * 
     */
    public InstanceMessageUpdateRequest.Variables createInstanceMessageUpdateRequestVariables() {
        return new InstanceMessageUpdateRequest.Variables();
    }

    /**
     * Create an instance of {@link InstanceSearchResponse.Items }
     * 
     */
    public InstanceSearchResponse.Items createInstanceSearchResponseItems() {
        return new InstanceSearchResponse.Items();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.References }
     * 
     */
    public InstanceMessageCreateRequest.References createInstanceMessageCreateRequestReferences() {
        return new InstanceMessageCreateRequest.References();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.Attachments }
     * 
     */
    public InstanceMessageCreateRequest.Attachments createInstanceMessageCreateRequestAttachments() {
        return new InstanceMessageCreateRequest.Attachments();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.Variables }
     * 
     */
    public InstanceMessageCreateRequest.Variables createInstanceMessageCreateRequestVariables() {
        return new InstanceMessageCreateRequest.Variables();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.Topics }
     * 
     */
    public InstanceMessageCreateRequest.Topics createInstanceMessageCreateRequestTopics() {
        return new InstanceMessageCreateRequest.Topics();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.Contacts }
     * 
     */
    public InstanceMessageCreateRequest.Contacts createInstanceMessageCreateRequestContacts() {
        return new InstanceMessageCreateRequest.Contacts();
    }

    /**
     * Create an instance of {@link InstanceOperationResponse }
     * 
     */
    public InstanceOperationResponse createInstanceOperationResponse() {
        return new InstanceOperationResponse();
    }

    /**
     * Create an instance of {@link InstanceMessageUpdateResponse }
     * 
     */
    public InstanceMessageUpdateResponse createInstanceMessageUpdateResponse() {
        return new InstanceMessageUpdateResponse();
    }

    /**
     * Create an instance of {@link InstancePreviewRequest }
     * 
     */
    public InstancePreviewRequest createInstancePreviewRequest() {
        return new InstancePreviewRequest();
    }

    /**
     * Create an instance of {@link InstanceActivityCreateResponse }
     * 
     */
    public InstanceActivityCreateResponse createInstanceActivityCreateResponse() {
        return new InstanceActivityCreateResponse();
    }

    /**
     * Create an instance of {@link InstanceSearchRequest }
     * 
     */
    public InstanceSearchRequest createInstanceSearchRequest() {
        return new InstanceSearchRequest();
    }

    /**
     * Create an instance of {@link InstancePreviewResponse }
     * 
     */
    public InstancePreviewResponse createInstancePreviewResponse() {
        return new InstancePreviewResponse();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateResponse }
     * 
     */
    public InstanceMessageCreateResponse createInstanceMessageCreateResponse() {
        return new InstanceMessageCreateResponse();
    }

    /**
     * Create an instance of {@link InstanceSignalResponse }
     * 
     */
    public InstanceSignalResponse createInstanceSignalResponse() {
        return new InstanceSignalResponse();
    }

    /**
     * Create an instance of {@link TaskCompleteResponse }
     * 
     */
    public TaskCompleteResponse createTaskCompleteResponse() {
        return new TaskCompleteResponse();
    }

    /**
     * Create an instance of {@link InstanceDetailRequest }
     * 
     */
    public InstanceDetailRequest createInstanceDetailRequest() {
        return new InstanceDetailRequest();
    }

    /**
     * Create an instance of {@link InstanceOperationRequest }
     * 
     */
    public InstanceOperationRequest createInstanceOperationRequest() {
        return new InstanceOperationRequest();
    }

    /**
     * Create an instance of {@link InstanceDetailResponse.Attachments.Attachment }
     * 
     */
    public InstanceDetailResponse.Attachments.Attachment createInstanceDetailResponseAttachmentsAttachment() {
        return new InstanceDetailResponse.Attachments.Attachment();
    }

    /**
     * Create an instance of {@link InstanceDetailResponse.Variables.Variable }
     * 
     */
    public InstanceDetailResponse.Variables.Variable createInstanceDetailResponseVariablesVariable() {
        return new InstanceDetailResponse.Variables.Variable();
    }

    /**
     * Create an instance of {@link InstanceDetailResponse.Contacts.Contact }
     * 
     */
    public InstanceDetailResponse.Contacts.Contact createInstanceDetailResponseContactsContact() {
        return new InstanceDetailResponse.Contacts.Contact();
    }

    /**
     * Create an instance of {@link InstanceSignalRequest.Variables.Variable }
     * 
     */
    public InstanceSignalRequest.Variables.Variable createInstanceSignalRequestVariablesVariable() {
        return new InstanceSignalRequest.Variables.Variable();
    }

    /**
     * Create an instance of {@link InstanceActivityCreateRequest.References.Reference }
     * 
     */
    public InstanceActivityCreateRequest.References.Reference createInstanceActivityCreateRequestReferencesReference() {
        return new InstanceActivityCreateRequest.References.Reference();
    }

    /**
     * Create an instance of {@link InstanceActivityCreateRequest.Attachments.Attachment }
     * 
     */
    public InstanceActivityCreateRequest.Attachments.Attachment createInstanceActivityCreateRequestAttachmentsAttachment() {
        return new InstanceActivityCreateRequest.Attachments.Attachment();
    }

    /**
     * Create an instance of {@link InstanceActivityCreateRequest.Variables.Variable }
     * 
     */
    public InstanceActivityCreateRequest.Variables.Variable createInstanceActivityCreateRequestVariablesVariable() {
        return new InstanceActivityCreateRequest.Variables.Variable();
    }

    /**
     * Create an instance of {@link TaskSearchResponse.Items.Item.Instance }
     * 
     */
    public TaskSearchResponse.Items.Item.Instance createTaskSearchResponseItemsItemInstance() {
        return new TaskSearchResponse.Items.Item.Instance();
    }

    /**
     * Create an instance of {@link TaskSearchRequest.Variables.Variable }
     * 
     */
    public TaskSearchRequest.Variables.Variable createTaskSearchRequestVariablesVariable() {
        return new TaskSearchRequest.Variables.Variable();
    }

    /**
     * Create an instance of {@link TaskCompleteRequest.Variables.Variable }
     * 
     */
    public TaskCompleteRequest.Variables.Variable createTaskCompleteRequestVariablesVariable() {
        return new TaskCompleteRequest.Variables.Variable();
    }

    /**
     * Create an instance of {@link InstanceMessageUpdateRequest.Attachments.Attachment }
     * 
     */
    public InstanceMessageUpdateRequest.Attachments.Attachment createInstanceMessageUpdateRequestAttachmentsAttachment() {
        return new InstanceMessageUpdateRequest.Attachments.Attachment();
    }

    /**
     * Create an instance of {@link InstanceMessageUpdateRequest.Variables.Variable }
     * 
     */
    public InstanceMessageUpdateRequest.Variables.Variable createInstanceMessageUpdateRequestVariablesVariable() {
        return new InstanceMessageUpdateRequest.Variables.Variable();
    }

    /**
     * Create an instance of {@link InstanceSearchResponse.Items.Item }
     * 
     */
    public InstanceSearchResponse.Items.Item createInstanceSearchResponseItemsItem() {
        return new InstanceSearchResponse.Items.Item();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.References.Reference }
     * 
     */
    public InstanceMessageCreateRequest.References.Reference createInstanceMessageCreateRequestReferencesReference() {
        return new InstanceMessageCreateRequest.References.Reference();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.Attachments.Attachment }
     * 
     */
    public InstanceMessageCreateRequest.Attachments.Attachment createInstanceMessageCreateRequestAttachmentsAttachment() {
        return new InstanceMessageCreateRequest.Attachments.Attachment();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.Variables.Variable }
     * 
     */
    public InstanceMessageCreateRequest.Variables.Variable createInstanceMessageCreateRequestVariablesVariable() {
        return new InstanceMessageCreateRequest.Variables.Variable();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.Topics.Topic }
     * 
     */
    public InstanceMessageCreateRequest.Topics.Topic createInstanceMessageCreateRequestTopicsTopic() {
        return new InstanceMessageCreateRequest.Topics.Topic();
    }

    /**
     * Create an instance of {@link InstanceMessageCreateRequest.Contacts.Contact }
     * 
     */
    public InstanceMessageCreateRequest.Contacts.Contact createInstanceMessageCreateRequestContactsContact() {
        return new InstanceMessageCreateRequest.Contacts.Contact();
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "contentType", scope = InstanceMessageUpdateRequest.Attachments.Attachment.class)
    public JAXBElement<String> createInstanceMessageUpdateRequestAttachmentsAttachmentContentType(String value) {
        return new JAXBElement<String>(_InstanceMessageUpdateRequestAttachmentsAttachmentContentType_QNAME, String.class, InstanceMessageUpdateRequest.Attachments.Attachment.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "contentType", scope = InstanceDetailResponse.Attachments.Attachment.class)
    public JAXBElement<String> createInstanceDetailResponseAttachmentsAttachmentContentType(String value) {
        return new JAXBElement<String>(_InstanceMessageUpdateRequestAttachmentsAttachmentContentType_QNAME, String.class, InstanceDetailResponse.Attachments.Attachment.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDate", scope = InstanceSignalRequest.Variables.Variable.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceSignalRequestVariablesVariableValueDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceSignalRequestVariablesVariableValueDate_QNAME, XMLGregorianCalendar.class, InstanceSignalRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueBoolean", scope = InstanceSignalRequest.Variables.Variable.class)
    public JAXBElement<Boolean> createInstanceSignalRequestVariablesVariableValueBoolean(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceSignalRequestVariablesVariableValueBoolean_QNAME, Boolean.class, InstanceSignalRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDecimal", scope = InstanceSignalRequest.Variables.Variable.class)
    public JAXBElement<BigDecimal> createInstanceSignalRequestVariablesVariableValueDecimal(BigDecimal value) {
        return new JAXBElement<BigDecimal>(_InstanceSignalRequestVariablesVariableValueDecimal_QNAME, BigDecimal.class, InstanceSignalRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueString", scope = InstanceSignalRequest.Variables.Variable.class)
    public JAXBElement<String> createInstanceSignalRequestVariablesVariableValueString(String value) {
        return new JAXBElement<String>(_InstanceSignalRequestVariablesVariableValueString_QNAME, String.class, InstanceSignalRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueInteger", scope = InstanceSignalRequest.Variables.Variable.class)
    public JAXBElement<BigInteger> createInstanceSignalRequestVariablesVariableValueInteger(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSignalRequestVariablesVariableValueInteger_QNAME, BigInteger.class, InstanceSignalRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "tags", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<String> createInstanceMessageCreateRequestTags(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestTags_QNAME, String.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "extAppIdentifierDate", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceMessageCreateRequestExtAppIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceMessageCreateRequestExtAppIdentifierDate_QNAME, XMLGregorianCalendar.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "body", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<String> createInstanceMessageCreateRequestBody(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestBody_QNAME, String.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "startWorkflow", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<Boolean> createInstanceMessageCreateRequestStartWorkflow(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceMessageCreateRequestStartWorkflow_QNAME, Boolean.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "subject", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<String> createInstanceMessageCreateRequestSubject(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestSubject_QNAME, String.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Contacts }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "contacts", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<InstanceMessageCreateRequest.Contacts> createInstanceMessageCreateRequestContacts(InstanceMessageCreateRequest.Contacts value) {
        return new JAXBElement<InstanceMessageCreateRequest.Contacts>(_InstanceMessageCreateRequestContacts_QNAME, InstanceMessageCreateRequest.Contacts.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Variables }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "variables", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<InstanceMessageCreateRequest.Variables> createInstanceMessageCreateRequestVariables(InstanceMessageCreateRequest.Variables value) {
        return new JAXBElement<InstanceMessageCreateRequest.Variables>(_InstanceMessageCreateRequestVariables_QNAME, InstanceMessageCreateRequest.Variables.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Topics }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "topics", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<InstanceMessageCreateRequest.Topics> createInstanceMessageCreateRequestTopics(InstanceMessageCreateRequest.Topics value) {
        return new JAXBElement<InstanceMessageCreateRequest.Topics>(_InstanceMessageCreateRequestTopics_QNAME, InstanceMessageCreateRequest.Topics.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.References }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "references", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<InstanceMessageCreateRequest.References> createInstanceMessageCreateRequestReferences(InstanceMessageCreateRequest.References value) {
        return new JAXBElement<InstanceMessageCreateRequest.References>(_InstanceMessageCreateRequestReferences_QNAME, InstanceMessageCreateRequest.References.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "extAppIdentifier", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<String> createInstanceMessageCreateRequestExtAppIdentifier(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestExtAppIdentifier_QNAME, String.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "instanceOperation", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<String> createInstanceMessageCreateRequestInstanceOperation(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestInstanceOperation_QNAME, String.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "scheduledSendDate", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceMessageCreateRequestScheduledSendDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceMessageCreateRequestScheduledSendDate_QNAME, XMLGregorianCalendar.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Attachments }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "attachments", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<InstanceMessageCreateRequest.Attachments> createInstanceMessageCreateRequestAttachments(InstanceMessageCreateRequest.Attachments value) {
        return new JAXBElement<InstanceMessageCreateRequest.Attachments>(_InstanceMessageCreateRequestAttachments_QNAME, InstanceMessageCreateRequest.Attachments.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "metaViewName", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<String> createInstanceMessageCreateRequestMetaViewName(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestMetaViewName_QNAME, String.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "note", scope = InstanceMessageCreateRequest.class)
    public JAXBElement<String> createInstanceMessageCreateRequestNote(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestNote_QNAME, String.class, InstanceMessageCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "identifierDate", scope = InstanceActivityCreateResponse.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceActivityCreateResponseIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceActivityCreateResponseIdentifierDate_QNAME, XMLGregorianCalendar.class, InstanceActivityCreateResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "identifier", scope = InstanceActivityCreateResponse.class)
    public JAXBElement<String> createInstanceActivityCreateResponseIdentifier(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateResponseIdentifier_QNAME, String.class, InstanceActivityCreateResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "viewUrl", scope = InstanceActivityCreateResponse.class)
    public JAXBElement<String> createInstanceActivityCreateResponseViewUrl(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateResponseViewUrl_QNAME, String.class, InstanceActivityCreateResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "info1", scope = InstanceMessageCreateRequest.Contacts.Contact.class)
    public JAXBElement<String> createInstanceMessageCreateRequestContactsContactInfo1(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestContactsContactInfo1_QNAME, String.class, InstanceMessageCreateRequest.Contacts.Contact.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "info3", scope = InstanceMessageCreateRequest.Contacts.Contact.class)
    public JAXBElement<String> createInstanceMessageCreateRequestContactsContactInfo3(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestContactsContactInfo3_QNAME, String.class, InstanceMessageCreateRequest.Contacts.Contact.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "info2", scope = InstanceMessageCreateRequest.Contacts.Contact.class)
    public JAXBElement<String> createInstanceMessageCreateRequestContactsContactInfo2(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestContactsContactInfo2_QNAME, String.class, InstanceMessageCreateRequest.Contacts.Contact.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDate", scope = InstanceDetailResponse.Variables.Variable.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceDetailResponseVariablesVariableValueDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceSignalRequestVariablesVariableValueDate_QNAME, XMLGregorianCalendar.class, InstanceDetailResponse.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueBoolean", scope = InstanceDetailResponse.Variables.Variable.class)
    public JAXBElement<Boolean> createInstanceDetailResponseVariablesVariableValueBoolean(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceSignalRequestVariablesVariableValueBoolean_QNAME, Boolean.class, InstanceDetailResponse.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDecimal", scope = InstanceDetailResponse.Variables.Variable.class)
    public JAXBElement<BigDecimal> createInstanceDetailResponseVariablesVariableValueDecimal(BigDecimal value) {
        return new JAXBElement<BigDecimal>(_InstanceSignalRequestVariablesVariableValueDecimal_QNAME, BigDecimal.class, InstanceDetailResponse.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueString", scope = InstanceDetailResponse.Variables.Variable.class)
    public JAXBElement<String> createInstanceDetailResponseVariablesVariableValueString(String value) {
        return new JAXBElement<String>(_InstanceSignalRequestVariablesVariableValueString_QNAME, String.class, InstanceDetailResponse.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueInteger", scope = InstanceDetailResponse.Variables.Variable.class)
    public JAXBElement<BigInteger> createInstanceDetailResponseVariablesVariableValueInteger(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSignalRequestVariablesVariableValueInteger_QNAME, BigInteger.class, InstanceDetailResponse.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceSearchResponse.Items }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "items", scope = InstanceSearchResponse.class)
    public JAXBElement<InstanceSearchResponse.Items> createInstanceSearchResponseItems(InstanceSearchResponse.Items value) {
        return new JAXBElement<InstanceSearchResponse.Items>(_InstanceSearchResponseItems_QNAME, InstanceSearchResponse.Items.class, InstanceSearchResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDate", scope = InstanceActivityCreateRequest.Variables.Variable.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceActivityCreateRequestVariablesVariableValueDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceSignalRequestVariablesVariableValueDate_QNAME, XMLGregorianCalendar.class, InstanceActivityCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueBoolean", scope = InstanceActivityCreateRequest.Variables.Variable.class)
    public JAXBElement<Boolean> createInstanceActivityCreateRequestVariablesVariableValueBoolean(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceSignalRequestVariablesVariableValueBoolean_QNAME, Boolean.class, InstanceActivityCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDecimal", scope = InstanceActivityCreateRequest.Variables.Variable.class)
    public JAXBElement<BigDecimal> createInstanceActivityCreateRequestVariablesVariableValueDecimal(BigDecimal value) {
        return new JAXBElement<BigDecimal>(_InstanceSignalRequestVariablesVariableValueDecimal_QNAME, BigDecimal.class, InstanceActivityCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueString", scope = InstanceActivityCreateRequest.Variables.Variable.class)
    public JAXBElement<String> createInstanceActivityCreateRequestVariablesVariableValueString(String value) {
        return new JAXBElement<String>(_InstanceSignalRequestVariablesVariableValueString_QNAME, String.class, InstanceActivityCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueInteger", scope = InstanceActivityCreateRequest.Variables.Variable.class)
    public JAXBElement<BigInteger> createInstanceActivityCreateRequestVariablesVariableValueInteger(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSignalRequestVariablesVariableValueInteger_QNAME, BigInteger.class, InstanceActivityCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "extAppIdentifierDate", scope = InstanceMessageUpdateRequest.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceMessageUpdateRequestExtAppIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceMessageCreateRequestExtAppIdentifierDate_QNAME, XMLGregorianCalendar.class, InstanceMessageUpdateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "tags", scope = InstanceMessageUpdateRequest.class)
    public JAXBElement<String> createInstanceMessageUpdateRequestTags(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestTags_QNAME, String.class, InstanceMessageUpdateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "body", scope = InstanceMessageUpdateRequest.class)
    public JAXBElement<String> createInstanceMessageUpdateRequestBody(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestBody_QNAME, String.class, InstanceMessageUpdateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "extAppIdentifier", scope = InstanceMessageUpdateRequest.class)
    public JAXBElement<String> createInstanceMessageUpdateRequestExtAppIdentifier(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestExtAppIdentifier_QNAME, String.class, InstanceMessageUpdateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "subject", scope = InstanceMessageUpdateRequest.class)
    public JAXBElement<String> createInstanceMessageUpdateRequestSubject(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestSubject_QNAME, String.class, InstanceMessageUpdateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "scheduledSendDate", scope = InstanceMessageUpdateRequest.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceMessageUpdateRequestScheduledSendDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceMessageCreateRequestScheduledSendDate_QNAME, XMLGregorianCalendar.class, InstanceMessageUpdateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceMessageUpdateRequest.Attachments }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "attachments", scope = InstanceMessageUpdateRequest.class)
    public JAXBElement<InstanceMessageUpdateRequest.Attachments> createInstanceMessageUpdateRequestAttachments(InstanceMessageUpdateRequest.Attachments value) {
        return new JAXBElement<InstanceMessageUpdateRequest.Attachments>(_InstanceMessageCreateRequestAttachments_QNAME, InstanceMessageUpdateRequest.Attachments.class, InstanceMessageUpdateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "note", scope = InstanceMessageUpdateRequest.class)
    public JAXBElement<String> createInstanceMessageUpdateRequestNote(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestNote_QNAME, String.class, InstanceMessageUpdateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceMessageUpdateRequest.Variables }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "variables", scope = InstanceMessageUpdateRequest.class)
    public JAXBElement<InstanceMessageUpdateRequest.Variables> createInstanceMessageUpdateRequestVariables(InstanceMessageUpdateRequest.Variables value) {
        return new JAXBElement<InstanceMessageUpdateRequest.Variables>(_InstanceMessageCreateRequestVariables_QNAME, InstanceMessageUpdateRequest.Variables.class, InstanceMessageUpdateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "archivied", scope = InstanceSearchRequest.class)
    public JAXBElement<Boolean> createInstanceSearchRequestArchivied(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceSearchRequestArchivied_QNAME, Boolean.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "folder", scope = InstanceSearchRequest.class)
    public JAXBElement<String> createInstanceSearchRequestFolder(String value) {
        return new JAXBElement<String>(_InstanceSearchRequestFolder_QNAME, String.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "organization", scope = InstanceSearchRequest.class)
    public JAXBElement<BigInteger> createInstanceSearchRequestOrganization(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSearchRequestOrganization_QNAME, BigInteger.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "max", scope = InstanceSearchRequest.class)
    public JAXBElement<BigInteger> createInstanceSearchRequestMax(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSearchRequestMax_QNAME, BigInteger.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "sort", scope = InstanceSearchRequest.class)
    public JAXBElement<String> createInstanceSearchRequestSort(String value) {
        return new JAXBElement<String>(_InstanceSearchRequestSort_QNAME, String.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "scope", scope = InstanceSearchRequest.class)
    public JAXBElement<String> createInstanceSearchRequestScope(String value) {
        return new JAXBElement<String>(_InstanceSearchRequestScope_QNAME, String.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "worknode", scope = InstanceSearchRequest.class)
    public JAXBElement<String> createInstanceSearchRequestWorknode(String value) {
        return new JAXBElement<String>(_InstanceSearchRequestWorknode_QNAME, String.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "start", scope = InstanceSearchRequest.class)
    public JAXBElement<BigInteger> createInstanceSearchRequestStart(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSearchRequestStart_QNAME, BigInteger.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "messagebox", scope = InstanceSearchRequest.class)
    public JAXBElement<BigInteger> createInstanceSearchRequestMessagebox(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSearchRequestMessagebox_QNAME, BigInteger.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "deleted", scope = InstanceSearchRequest.class)
    public JAXBElement<Boolean> createInstanceSearchRequestDeleted(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceSearchRequestDeleted_QNAME, Boolean.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "spotlight", scope = InstanceSearchRequest.class)
    public JAXBElement<String> createInstanceSearchRequestSpotlight(String value) {
        return new JAXBElement<String>(_InstanceSearchRequestSpotlight_QNAME, String.class, InstanceSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceSignalRequest.Variables }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "variables", scope = InstanceSignalRequest.class)
    public JAXBElement<InstanceSignalRequest.Variables> createInstanceSignalRequestVariables(InstanceSignalRequest.Variables value) {
        return new JAXBElement<InstanceSignalRequest.Variables>(_InstanceMessageCreateRequestVariables_QNAME, InstanceSignalRequest.Variables.class, InstanceSignalRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "id", scope = InstanceActivityCreateRequest.References.Reference.class)
    public JAXBElement<BigInteger> createInstanceActivityCreateRequestReferencesReferenceId(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceActivityCreateRequestReferencesReferenceId_QNAME, BigInteger.class, InstanceActivityCreateRequest.References.Reference.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "appIdentifier", scope = InstanceActivityCreateRequest.References.Reference.class)
    public JAXBElement<String> createInstanceActivityCreateRequestReferencesReferenceAppIdentifier(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateRequestReferencesReferenceAppIdentifier_QNAME, String.class, InstanceActivityCreateRequest.References.Reference.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "appIdentifierDate", scope = InstanceActivityCreateRequest.References.Reference.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceActivityCreateRequestReferencesReferenceAppIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceActivityCreateRequestReferencesReferenceAppIdentifierDate_QNAME, XMLGregorianCalendar.class, InstanceActivityCreateRequest.References.Reference.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "contentType", scope = InstanceMessageCreateRequest.Attachments.Attachment.class)
    public JAXBElement<String> createInstanceMessageCreateRequestAttachmentsAttachmentContentType(String value) {
        return new JAXBElement<String>(_InstanceMessageUpdateRequestAttachmentsAttachmentContentType_QNAME, String.class, InstanceMessageCreateRequest.Attachments.Attachment.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "id", scope = InstanceMessageCreateRequest.References.Reference.class)
    public JAXBElement<BigInteger> createInstanceMessageCreateRequestReferencesReferenceId(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceActivityCreateRequestReferencesReferenceId_QNAME, BigInteger.class, InstanceMessageCreateRequest.References.Reference.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "appIdentifier", scope = InstanceMessageCreateRequest.References.Reference.class)
    public JAXBElement<String> createInstanceMessageCreateRequestReferencesReferenceAppIdentifier(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateRequestReferencesReferenceAppIdentifier_QNAME, String.class, InstanceMessageCreateRequest.References.Reference.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "appIdentifierDate", scope = InstanceMessageCreateRequest.References.Reference.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceMessageCreateRequestReferencesReferenceAppIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceActivityCreateRequestReferencesReferenceAppIdentifierDate_QNAME, XMLGregorianCalendar.class, InstanceMessageCreateRequest.References.Reference.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDate", scope = TaskSearchRequest.Variables.Variable.class)
    public JAXBElement<XMLGregorianCalendar> createTaskSearchRequestVariablesVariableValueDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceSignalRequestVariablesVariableValueDate_QNAME, XMLGregorianCalendar.class, TaskSearchRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueBoolean", scope = TaskSearchRequest.Variables.Variable.class)
    public JAXBElement<Boolean> createTaskSearchRequestVariablesVariableValueBoolean(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceSignalRequestVariablesVariableValueBoolean_QNAME, Boolean.class, TaskSearchRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDecimal", scope = TaskSearchRequest.Variables.Variable.class)
    public JAXBElement<BigDecimal> createTaskSearchRequestVariablesVariableValueDecimal(BigDecimal value) {
        return new JAXBElement<BigDecimal>(_InstanceSignalRequestVariablesVariableValueDecimal_QNAME, BigDecimal.class, TaskSearchRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueString", scope = TaskSearchRequest.Variables.Variable.class)
    public JAXBElement<String> createTaskSearchRequestVariablesVariableValueString(String value) {
        return new JAXBElement<String>(_InstanceSignalRequestVariablesVariableValueString_QNAME, String.class, TaskSearchRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueInteger", scope = TaskSearchRequest.Variables.Variable.class)
    public JAXBElement<BigInteger> createTaskSearchRequestVariablesVariableValueInteger(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSignalRequestVariablesVariableValueInteger_QNAME, BigInteger.class, TaskSearchRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "identifierDate", scope = InstanceMessageCreateResponse.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceMessageCreateResponseIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceActivityCreateResponseIdentifierDate_QNAME, XMLGregorianCalendar.class, InstanceMessageCreateResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "identifier", scope = InstanceMessageCreateResponse.class)
    public JAXBElement<String> createInstanceMessageCreateResponseIdentifier(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateResponseIdentifier_QNAME, String.class, InstanceMessageCreateResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "viewUrl", scope = InstanceMessageCreateResponse.class)
    public JAXBElement<String> createInstanceMessageCreateResponseViewUrl(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateResponseViewUrl_QNAME, String.class, InstanceMessageCreateResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDate", scope = TaskCompleteRequest.Variables.Variable.class)
    public JAXBElement<XMLGregorianCalendar> createTaskCompleteRequestVariablesVariableValueDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceSignalRequestVariablesVariableValueDate_QNAME, XMLGregorianCalendar.class, TaskCompleteRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueBoolean", scope = TaskCompleteRequest.Variables.Variable.class)
    public JAXBElement<Boolean> createTaskCompleteRequestVariablesVariableValueBoolean(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceSignalRequestVariablesVariableValueBoolean_QNAME, Boolean.class, TaskCompleteRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDecimal", scope = TaskCompleteRequest.Variables.Variable.class)
    public JAXBElement<BigDecimal> createTaskCompleteRequestVariablesVariableValueDecimal(BigDecimal value) {
        return new JAXBElement<BigDecimal>(_InstanceSignalRequestVariablesVariableValueDecimal_QNAME, BigDecimal.class, TaskCompleteRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueString", scope = TaskCompleteRequest.Variables.Variable.class)
    public JAXBElement<String> createTaskCompleteRequestVariablesVariableValueString(String value) {
        return new JAXBElement<String>(_InstanceSignalRequestVariablesVariableValueString_QNAME, String.class, TaskCompleteRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueInteger", scope = TaskCompleteRequest.Variables.Variable.class)
    public JAXBElement<BigInteger> createTaskCompleteRequestVariablesVariableValueInteger(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSignalRequestVariablesVariableValueInteger_QNAME, BigInteger.class, TaskCompleteRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "referenceCode", scope = InstanceDetailResponse.Contacts.Contact.class)
    public JAXBElement<String> createInstanceDetailResponseContactsContactReferenceCode(String value) {
        return new JAXBElement<String>(_InstanceDetailResponseContactsContactReferenceCode_QNAME, String.class, InstanceDetailResponse.Contacts.Contact.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "info1", scope = InstanceDetailResponse.Contacts.Contact.class)
    public JAXBElement<String> createInstanceDetailResponseContactsContactInfo1(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestContactsContactInfo1_QNAME, String.class, InstanceDetailResponse.Contacts.Contact.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "externalId", scope = InstanceDetailResponse.Contacts.Contact.class)
    public JAXBElement<String> createInstanceDetailResponseContactsContactExternalId(String value) {
        return new JAXBElement<String>(_InstanceDetailResponseContactsContactExternalId_QNAME, String.class, InstanceDetailResponse.Contacts.Contact.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "info3", scope = InstanceDetailResponse.Contacts.Contact.class)
    public JAXBElement<String> createInstanceDetailResponseContactsContactInfo3(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestContactsContactInfo3_QNAME, String.class, InstanceDetailResponse.Contacts.Contact.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "info2", scope = InstanceDetailResponse.Contacts.Contact.class)
    public JAXBElement<String> createInstanceDetailResponseContactsContactInfo2(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestContactsContactInfo2_QNAME, String.class, InstanceDetailResponse.Contacts.Contact.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "contentType", scope = InstanceActivityCreateRequest.Attachments.Attachment.class)
    public JAXBElement<String> createInstanceActivityCreateRequestAttachmentsAttachmentContentType(String value) {
        return new JAXBElement<String>(_InstanceMessageUpdateRequestAttachmentsAttachmentContentType_QNAME, String.class, InstanceActivityCreateRequest.Attachments.Attachment.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "title", scope = TaskSearchResponse.Items.Item.Instance.class)
    public JAXBElement<String> createTaskSearchResponseItemsItemInstanceTitle(String value) {
        return new JAXBElement<String>(_TaskSearchResponseItemsItemInstanceTitle_QNAME, String.class, TaskSearchResponse.Items.Item.Instance.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "status", scope = TaskSearchResponse.Items.Item.Instance.class)
    public JAXBElement<String> createTaskSearchResponseItemsItemInstanceStatus(String value) {
        return new JAXBElement<String>(_TaskSearchResponseItemsItemInstanceStatus_QNAME, String.class, TaskSearchResponse.Items.Item.Instance.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "subject", scope = TaskSearchResponse.Items.Item.Instance.class)
    public JAXBElement<String> createTaskSearchResponseItemsItemInstanceSubject(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestSubject_QNAME, String.class, TaskSearchResponse.Items.Item.Instance.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "sbName", scope = TaskSearchResponse.Items.Item.Instance.class)
    public JAXBElement<String> createTaskSearchResponseItemsItemInstanceSbName(String value) {
        return new JAXBElement<String>(_TaskSearchResponseItemsItemInstanceSbName_QNAME, String.class, TaskSearchResponse.Items.Item.Instance.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "appIdentifier", scope = TaskSearchResponse.Items.Item.Instance.class)
    public JAXBElement<String> createTaskSearchResponseItemsItemInstanceAppIdentifier(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateRequestReferencesReferenceAppIdentifier_QNAME, String.class, TaskSearchResponse.Items.Item.Instance.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "appIdentifierDate", scope = TaskSearchResponse.Items.Item.Instance.class)
    public JAXBElement<XMLGregorianCalendar> createTaskSearchResponseItemsItemInstanceAppIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceActivityCreateRequestReferencesReferenceAppIdentifierDate_QNAME, XMLGregorianCalendar.class, TaskSearchResponse.Items.Item.Instance.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link TaskSearchResponse.Items }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "items", scope = TaskSearchResponse.class)
    public JAXBElement<TaskSearchResponse.Items> createTaskSearchResponseItems(TaskSearchResponse.Items value) {
        return new JAXBElement<TaskSearchResponse.Items>(_InstanceSearchResponseItems_QNAME, TaskSearchResponse.Items.class, TaskSearchResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "identifierDate", scope = InstanceMessageUpdateResponse.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceMessageUpdateResponseIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceActivityCreateResponseIdentifierDate_QNAME, XMLGregorianCalendar.class, InstanceMessageUpdateResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "identifier", scope = InstanceMessageUpdateResponse.class)
    public JAXBElement<String> createInstanceMessageUpdateResponseIdentifier(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateResponseIdentifier_QNAME, String.class, InstanceMessageUpdateResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "viewUrl", scope = InstanceMessageUpdateResponse.class)
    public JAXBElement<String> createInstanceMessageUpdateResponseViewUrl(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateResponseViewUrl_QNAME, String.class, InstanceMessageUpdateResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "tags", scope = InstanceDetailResponse.class)
    public JAXBElement<String> createInstanceDetailResponseTags(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestTags_QNAME, String.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "body", scope = InstanceDetailResponse.class)
    public JAXBElement<String> createInstanceDetailResponseBody(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestBody_QNAME, String.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "subject", scope = InstanceDetailResponse.class)
    public JAXBElement<String> createInstanceDetailResponseSubject(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestSubject_QNAME, String.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "direction", scope = InstanceDetailResponse.class)
    public JAXBElement<String> createInstanceDetailResponseDirection(String value) {
        return new JAXBElement<String>(_InstanceDetailResponseDirection_QNAME, String.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceDetailResponse.Attachments }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "attachments", scope = InstanceDetailResponse.class)
    public JAXBElement<InstanceDetailResponse.Attachments> createInstanceDetailResponseAttachments(InstanceDetailResponse.Attachments value) {
        return new JAXBElement<InstanceDetailResponse.Attachments>(_InstanceMessageCreateRequestAttachments_QNAME, InstanceDetailResponse.Attachments.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "metaViewName", scope = InstanceDetailResponse.class)
    public JAXBElement<String> createInstanceDetailResponseMetaViewName(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestMetaViewName_QNAME, String.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "identifierDate", scope = InstanceDetailResponse.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceDetailResponseIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceActivityCreateResponseIdentifierDate_QNAME, XMLGregorianCalendar.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "identifier", scope = InstanceDetailResponse.class)
    public JAXBElement<String> createInstanceDetailResponseIdentifier(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateResponseIdentifier_QNAME, String.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "note", scope = InstanceDetailResponse.class)
    public JAXBElement<String> createInstanceDetailResponseNote(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestNote_QNAME, String.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceDetailResponse.Variables }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "variables", scope = InstanceDetailResponse.class)
    public JAXBElement<InstanceDetailResponse.Variables> createInstanceDetailResponseVariables(InstanceDetailResponse.Variables value) {
        return new JAXBElement<InstanceDetailResponse.Variables>(_InstanceMessageCreateRequestVariables_QNAME, InstanceDetailResponse.Variables.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceDetailResponse.Contacts }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "contacts", scope = InstanceDetailResponse.class)
    public JAXBElement<InstanceDetailResponse.Contacts> createInstanceDetailResponseContacts(InstanceDetailResponse.Contacts value) {
        return new JAXBElement<InstanceDetailResponse.Contacts>(_InstanceMessageCreateRequestContacts_QNAME, InstanceDetailResponse.Contacts.class, InstanceDetailResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "max", scope = TaskSearchRequest.class)
    public JAXBElement<BigInteger> createTaskSearchRequestMax(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSearchRequestMax_QNAME, BigInteger.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "sort", scope = TaskSearchRequest.class)
    public JAXBElement<String> createTaskSearchRequestSort(String value) {
        return new JAXBElement<String>(_InstanceSearchRequestSort_QNAME, String.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "start", scope = TaskSearchRequest.class)
    public JAXBElement<BigInteger> createTaskSearchRequestStart(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSearchRequestStart_QNAME, BigInteger.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "taskDefinitionKey", scope = TaskSearchRequest.class)
    public JAXBElement<String> createTaskSearchRequestTaskDefinitionKey(String value) {
        return new JAXBElement<String>(_TaskSearchRequestTaskDefinitionKey_QNAME, String.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "owner", scope = TaskSearchRequest.class)
    public JAXBElement<String> createTaskSearchRequestOwner(String value) {
        return new JAXBElement<String>(_TaskSearchRequestOwner_QNAME, String.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "instanceId", scope = TaskSearchRequest.class)
    public JAXBElement<BigInteger> createTaskSearchRequestInstanceId(BigInteger value) {
        return new JAXBElement<BigInteger>(_TaskSearchRequestInstanceId_QNAME, BigInteger.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "assignee", scope = TaskSearchRequest.class)
    public JAXBElement<String> createTaskSearchRequestAssignee(String value) {
        return new JAXBElement<String>(_TaskSearchRequestAssignee_QNAME, String.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "storyboardCode", scope = TaskSearchRequest.class)
    public JAXBElement<String> createTaskSearchRequestStoryboardCode(String value) {
        return new JAXBElement<String>(_TaskSearchRequestStoryboardCode_QNAME, String.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "dueDate", scope = TaskSearchRequest.class)
    public JAXBElement<XMLGregorianCalendar> createTaskSearchRequestDueDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_TaskSearchRequestDueDate_QNAME, XMLGregorianCalendar.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link TaskSearchRequest.Variables }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "variables", scope = TaskSearchRequest.class)
    public JAXBElement<TaskSearchRequest.Variables> createTaskSearchRequestVariables(TaskSearchRequest.Variables value) {
        return new JAXBElement<TaskSearchRequest.Variables>(_InstanceMessageCreateRequestVariables_QNAME, TaskSearchRequest.Variables.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "completed", scope = TaskSearchRequest.class)
    public JAXBElement<Boolean> createTaskSearchRequestCompleted(Boolean value) {
        return new JAXBElement<Boolean>(_TaskSearchRequestCompleted_QNAME, Boolean.class, TaskSearchRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDate", scope = InstanceMessageUpdateRequest.Variables.Variable.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceMessageUpdateRequestVariablesVariableValueDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceSignalRequestVariablesVariableValueDate_QNAME, XMLGregorianCalendar.class, InstanceMessageUpdateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueBoolean", scope = InstanceMessageUpdateRequest.Variables.Variable.class)
    public JAXBElement<Boolean> createInstanceMessageUpdateRequestVariablesVariableValueBoolean(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceSignalRequestVariablesVariableValueBoolean_QNAME, Boolean.class, InstanceMessageUpdateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDecimal", scope = InstanceMessageUpdateRequest.Variables.Variable.class)
    public JAXBElement<BigDecimal> createInstanceMessageUpdateRequestVariablesVariableValueDecimal(BigDecimal value) {
        return new JAXBElement<BigDecimal>(_InstanceSignalRequestVariablesVariableValueDecimal_QNAME, BigDecimal.class, InstanceMessageUpdateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueString", scope = InstanceMessageUpdateRequest.Variables.Variable.class)
    public JAXBElement<String> createInstanceMessageUpdateRequestVariablesVariableValueString(String value) {
        return new JAXBElement<String>(_InstanceSignalRequestVariablesVariableValueString_QNAME, String.class, InstanceMessageUpdateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueInteger", scope = InstanceMessageUpdateRequest.Variables.Variable.class)
    public JAXBElement<BigInteger> createInstanceMessageUpdateRequestVariablesVariableValueInteger(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSignalRequestVariablesVariableValueInteger_QNAME, BigInteger.class, InstanceMessageUpdateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "note", scope = TaskCompleteRequest.class)
    public JAXBElement<String> createTaskCompleteRequestNote(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestNote_QNAME, String.class, TaskCompleteRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link TaskCompleteRequest.Variables }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "variables", scope = TaskCompleteRequest.class)
    public JAXBElement<TaskCompleteRequest.Variables> createTaskCompleteRequestVariables(TaskCompleteRequest.Variables value) {
        return new JAXBElement<TaskCompleteRequest.Variables>(_InstanceMessageCreateRequestVariables_QNAME, TaskCompleteRequest.Variables.class, TaskCompleteRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "message", scope = TaskCompleteResponse.class)
    public JAXBElement<String> createTaskCompleteResponseMessage(String value) {
        return new JAXBElement<String>(_TaskCompleteResponseMessage_QNAME, String.class, TaskCompleteResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "instanceId", scope = TaskCompleteResponse.class)
    public JAXBElement<BigInteger> createTaskCompleteResponseInstanceId(BigInteger value) {
        return new JAXBElement<BigInteger>(_TaskSearchRequestInstanceId_QNAME, BigInteger.class, TaskCompleteResponse.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "to", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<String> createInstanceSearchResponseItemsItemTo(String value) {
        return new JAXBElement<String>(_InstanceSearchResponseItemsItemTo_QNAME, String.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "title", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<String> createInstanceSearchResponseItemsItemTitle(String value) {
        return new JAXBElement<String>(_TaskSearchResponseItemsItemInstanceTitle_QNAME, String.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "status", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<String> createInstanceSearchResponseItemsItemStatus(String value) {
        return new JAXBElement<String>(_TaskSearchResponseItemsItemInstanceStatus_QNAME, String.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "subject", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<String> createInstanceSearchResponseItemsItemSubject(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestSubject_QNAME, String.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "sbName", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<String> createInstanceSearchResponseItemsItemSbName(String value) {
        return new JAXBElement<String>(_TaskSearchResponseItemsItemInstanceSbName_QNAME, String.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "appIdentifier", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<String> createInstanceSearchResponseItemsItemAppIdentifier(String value) {
        return new JAXBElement<String>(_InstanceActivityCreateRequestReferencesReferenceAppIdentifier_QNAME, String.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "appIdentifierDate", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceSearchResponseItemsItemAppIdentifierDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceActivityCreateRequestReferencesReferenceAppIdentifierDate_QNAME, XMLGregorianCalendar.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "from", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<String> createInstanceSearchResponseItemsItemFrom(String value) {
        return new JAXBElement<String>(_InstanceSearchResponseItemsItemFrom_QNAME, String.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "mboxName", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<String> createInstanceSearchResponseItemsItemMboxName(String value) {
        return new JAXBElement<String>(_InstanceSearchResponseItemsItemMboxName_QNAME, String.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "cc", scope = InstanceSearchResponse.Items.Item.class)
    public JAXBElement<String> createInstanceSearchResponseItemsItemCc(String value) {
        return new JAXBElement<String>(_InstanceSearchResponseItemsItemCc_QNAME, String.class, InstanceSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDate", scope = InstanceMessageCreateRequest.Variables.Variable.class)
    public JAXBElement<XMLGregorianCalendar> createInstanceMessageCreateRequestVariablesVariableValueDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_InstanceSignalRequestVariablesVariableValueDate_QNAME, XMLGregorianCalendar.class, InstanceMessageCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueBoolean", scope = InstanceMessageCreateRequest.Variables.Variable.class)
    public JAXBElement<Boolean> createInstanceMessageCreateRequestVariablesVariableValueBoolean(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceSignalRequestVariablesVariableValueBoolean_QNAME, Boolean.class, InstanceMessageCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueDecimal", scope = InstanceMessageCreateRequest.Variables.Variable.class)
    public JAXBElement<BigDecimal> createInstanceMessageCreateRequestVariablesVariableValueDecimal(BigDecimal value) {
        return new JAXBElement<BigDecimal>(_InstanceSignalRequestVariablesVariableValueDecimal_QNAME, BigDecimal.class, InstanceMessageCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueString", scope = InstanceMessageCreateRequest.Variables.Variable.class)
    public JAXBElement<String> createInstanceMessageCreateRequestVariablesVariableValueString(String value) {
        return new JAXBElement<String>(_InstanceSignalRequestVariablesVariableValueString_QNAME, String.class, InstanceMessageCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "valueInteger", scope = InstanceMessageCreateRequest.Variables.Variable.class)
    public JAXBElement<BigInteger> createInstanceMessageCreateRequestVariablesVariableValueInteger(BigInteger value) {
        return new JAXBElement<BigInteger>(_InstanceSignalRequestVariablesVariableValueInteger_QNAME, BigInteger.class, InstanceMessageCreateRequest.Variables.Variable.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceActivityCreateRequest.References }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "references", scope = InstanceActivityCreateRequest.class)
    public JAXBElement<InstanceActivityCreateRequest.References> createInstanceActivityCreateRequestReferences(InstanceActivityCreateRequest.References value) {
        return new JAXBElement<InstanceActivityCreateRequest.References>(_InstanceMessageCreateRequestReferences_QNAME, InstanceActivityCreateRequest.References.class, InstanceActivityCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link Boolean }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "startWorkflow", scope = InstanceActivityCreateRequest.class)
    public JAXBElement<Boolean> createInstanceActivityCreateRequestStartWorkflow(Boolean value) {
        return new JAXBElement<Boolean>(_InstanceMessageCreateRequestStartWorkflow_QNAME, Boolean.class, InstanceActivityCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "subject", scope = InstanceActivityCreateRequest.class)
    public JAXBElement<String> createInstanceActivityCreateRequestSubject(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestSubject_QNAME, String.class, InstanceActivityCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "instanceOperation", scope = InstanceActivityCreateRequest.class)
    public JAXBElement<String> createInstanceActivityCreateRequestInstanceOperation(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestInstanceOperation_QNAME, String.class, InstanceActivityCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceActivityCreateRequest.Attachments }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "attachments", scope = InstanceActivityCreateRequest.class)
    public JAXBElement<InstanceActivityCreateRequest.Attachments> createInstanceActivityCreateRequestAttachments(InstanceActivityCreateRequest.Attachments value) {
        return new JAXBElement<InstanceActivityCreateRequest.Attachments>(_InstanceMessageCreateRequestAttachments_QNAME, InstanceActivityCreateRequest.Attachments.class, InstanceActivityCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "metaViewName", scope = InstanceActivityCreateRequest.class)
    public JAXBElement<String> createInstanceActivityCreateRequestMetaViewName(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestMetaViewName_QNAME, String.class, InstanceActivityCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "note", scope = InstanceActivityCreateRequest.class)
    public JAXBElement<String> createInstanceActivityCreateRequestNote(String value) {
        return new JAXBElement<String>(_InstanceMessageCreateRequestNote_QNAME, String.class, InstanceActivityCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link InstanceActivityCreateRequest.Variables }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "variables", scope = InstanceActivityCreateRequest.class)
    public JAXBElement<InstanceActivityCreateRequest.Variables> createInstanceActivityCreateRequestVariables(InstanceActivityCreateRequest.Variables value) {
        return new JAXBElement<InstanceActivityCreateRequest.Variables>(_InstanceMessageCreateRequestVariables_QNAME, InstanceActivityCreateRequest.Variables.class, InstanceActivityCreateRequest.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link BigInteger }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "priority", scope = TaskSearchResponse.Items.Item.class)
    public JAXBElement<BigInteger> createTaskSearchResponseItemsItemPriority(BigInteger value) {
        return new JAXBElement<BigInteger>(_TaskSearchResponseItemsItemPriority_QNAME, BigInteger.class, TaskSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "owner", scope = TaskSearchResponse.Items.Item.class)
    public JAXBElement<String> createTaskSearchResponseItemsItemOwner(String value) {
        return new JAXBElement<String>(_TaskSearchRequestOwner_QNAME, String.class, TaskSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link String }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "assignee", scope = TaskSearchResponse.Items.Item.class)
    public JAXBElement<String> createTaskSearchResponseItemsItemAssignee(String value) {
        return new JAXBElement<String>(_TaskSearchRequestAssignee_QNAME, String.class, TaskSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "dueDate", scope = TaskSearchResponse.Items.Item.class)
    public JAXBElement<XMLGregorianCalendar> createTaskSearchResponseItemsItemDueDate(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_TaskSearchRequestDueDate_QNAME, XMLGregorianCalendar.class, TaskSearchResponse.Items.Item.class, value);
    }

    /**
     * Create an instance of {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}}
     * 
     */
    @XmlElementDecl(namespace = "", name = "completed", scope = TaskSearchResponse.Items.Item.class)
    public JAXBElement<XMLGregorianCalendar> createTaskSearchResponseItemsItemCompleted(XMLGregorianCalendar value) {
        return new JAXBElement<XMLGregorianCalendar>(_TaskSearchRequestCompleted_QNAME, XMLGregorianCalendar.class, TaskSearchResponse.Items.Item.class, value);
    }

}
